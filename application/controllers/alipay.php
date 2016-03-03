<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alipay extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		//APPPATH.
		require_once(APPPATH."third_party/alipay/alipay_submit.class.php");
		require_once(APPPATH."third_party/alipay/alipay_notify.class.php");
		// 加载支付宝配置
    	$this->config->load('alipay', TRUE);
		$this->data['title'] = '支付宝支付';
		$this->data['nav'] = 'donation';
		$this->load->model('donation_mdl');
		$this->load->model('wishboard_mdl');
        $this->load->model('iptool_mdl');
	}

	public function index()
	{	
		$templeid = $this->session->userdata('templeid');
		if($this->cart->total() == 0)
			redirect('temple/id/'.$templeid,'refresh');
		//生成订单
		//生成订单
		if($this->session->userdata('realname') == null){
			$ipInfos = $this->iptool_mdl->GetIpLookup($this->iptool_mdl->GetIp());
	    	$location = $ipInfos['province'].$ipInfos['city']."匿名";
	    	$this->session->set_userdata('realname',$location);
		}
		$contact = $this->session->userdata('realname');
		$mobile = $this->session->userdata('mobile');
		$username = $this->session->userdata('username');
		$status = '未支付';
		$ordertime = date("Y-m-d H:i:s");
		//订单号编号规则
		$id = "D".date("YmdHis").substr(md5($ordertime),0,6);
		
		$result = $this->donation_mdl->add_order(array('id'=>$id,'contact' => $contact,'mobile' => $mobile
			,'username' => $username,'total' => $this->cart->total(),'status' => $status,'ordertime' => $ordertime
			,'templeid' => $templeid));
		if($result)
			$this->session->set_userdata('donation_order_id',$id);
		//生成order_item
		foreach ($this->cart->contents() as $item) {
			$oi = array('orderid' => $id,'donationid' => $item['id'],'count' => $item['qty']);
			$this->donation_mdl->add_order_item($oi);
		}
			
		//支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = base_url()."alipay/notify_process";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = base_url()."alipay/return_process";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户
        $seller_email = 'irockwill@163.com';
        //必填
        //商户订单号
        $out_trade_no = $this->session->userdata('donation_order_id');
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = "智慧寺院供养订单";
        //必填
        //付款金额
        $total_fee = $this->cart->total();
        //必填
        //订单描述
        $body = "订单描述";
        //商品展示地址
        $show_url = "http://www.baidu.com";
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1
		/************************************************************/
		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "create_direct_pay_by_user",
				"partner" => $this->config->item('partner', 'alipay'),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,
				"_input_charset"	=> $this->config->item('input_charset', 'alipay')
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($this->config->item('alipay'));
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "jumping...");
		echo $html_text;
		//销毁购物车
		$this->cart->destroy();
	}

	public function pay($orderid)
	{	
		//支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = base_url()."alipay/notify_process";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = base_url()."alipay/return_process";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户
        $seller_email = 'irockwill@163.com';
        //必填
        //商户订单号
        $out_trade_no = $orderid;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = "智慧寺院供养订单";
        //必填
        //付款金额
		$order = $this->donation_mdl->get_order_info($orderid);
        $total_fee = $order->total;
        //必填
        //订单描述
        $body = "订单描述";
        //商品展示地址
        $show_url = "http://www.baidu.com";
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1
		/************************************************************/
		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "create_direct_pay_by_user",
				"partner" => $this->config->item('partner', 'alipay'),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,
				"_input_charset"	=> $this->config->item('input_charset', 'alipay')
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($this->config->item('alipay'));
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "jumping...");
		echo $html_text;
	}

	public function notify_process()
	{
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($this->config->item('alipay'));
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//请在这里加上商户的业务逻辑程序代

		//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		
	    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
		
		//商户订单号
		$input = $this->input->post();
		$out_trade_no = $input['out_trade_no'];

		//支付宝交易号

		$trade_no = $input['trade_no'];

		//交易状态
		$trade_status = $input['trade_status'];


	    if($input['trade_status'] == 'TRADE_FINISHED') {
			//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
					
			//注意：
			//该种交易状态只在两种情况下出现
			//1、开通了普通即时到账，买家付款成功后。
			//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

	        //调试用，写文本函数记录程序运行情况是否正常
	        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
	    }
	    else if ($input['trade_status'] == 'TRADE_SUCCESS') {
			//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
					
			//注意：
			//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

	        //调试用，写文本函数记录程序运行情况是否正常
	        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
	    }

		//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	    $donation_order_id = $out_trade_no;
	    $this->donation_mdl->update_order($donation_order_id, array('status' => '支付成功'));
	    //重置购物车和order session
	    $this->cart->destroy();
	    $this->session->set_userdata('donation_order_id','');
	    //更新供养物的数量信息
	    $order_items = $this->donation_mdl->get_order_items($donation_order_id);
	    foreach ($order_items as $item) {
	    	$this->donation_mdl->update_soldcount($item->id);
	    }
	    //发布一条供养成功的祈福消息
	    $order = $this->donation_mdl->get_order_info($donation_order_id);
        $total_fee = $order->total; //供养花费
        $content = "虔诚供养".$order_items[0]->name."等共计".$total_fee."元。功德无量，阿弥陀佛！";
        $datetime = date("Y-m-d H:i:s");
        $templeid = $this->session->userdata('templeid');
        $ipInfos = $this->iptool_mdl->GetIpLookup($this->iptool_mdl->GetIp());
        $location = $ipInfos['province'].$ipInfos['city'];
        $param = array(
            'userid'=>$this->session->userdata('realname'),
            'content'=>$content,
            'parentid'=>0,
            'datetime'=>$datetime,
            'templeid'=>$templeid,
            'location'=>$location);
        $this->wishboard_mdl->add($param);
        //重定向
	    redirect('user/home/order/'.$donation_order_id,'refresh');    
		echo "success";		//请不要修改或删除
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    echo "fail";

		    //调试用，写文本函数记录程序运行情况是否正常
		    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}
	}

	public function return_process()
	{
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($this->config->item('alipay'));
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

			//商户订单号
			$input = $this->input->get();

			$out_trade_no = $input['out_trade_no'];

			//支付宝交易号

			$trade_no = $input['trade_no'];

			//交易状态
			$trade_status = $input['trade_status'];


		    if($input['trade_status'] == 'TRADE_FINISHED' || $input['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序
		    }
		    else {
		      echo "trade_status=".$input['trade_status'];
		    }
				
			//echo "Success<br />";
		    //支付成功后的逻辑
		   	$donation_order_id = $out_trade_no;
		    $this->donation_mdl->update_order($donation_order_id, array('status' => '支付成功'));
		    //重置购物车和order session
		    $this->cart->destroy();
		    $this->session->set_userdata('donation_order_id','');
		    //更新供养物的数量信息
		    $order_items = $this->donation_mdl->get_order_items($donation_order_id);
		    foreach ($order_items as $item) {
		    	$this->donation_mdl->update_soldcount($item->id);
		    }
		    //发布一条供养成功的祈福消息
		    $order = $this->donation_mdl->get_order_info($donation_order_id);
	        $total_fee = $order->total; //供养花费
	        $content = "虔诚供养".$order_items[0]->name."等共计".$total_fee."元。功德无量，阿弥陀佛！";
	        $datetime = date("Y-m-d H:i:s");
	        $templeid = $this->session->userdata('templeid');
	        $ipInfos = $this->iptool_mdl->GetIpLookup($this->iptool_mdl->GetIp());
	        $location = $ipInfos['province'].$ipInfos['city'];
	        $param = array(
	            'userid'=>$this->session->userdata('realname'),
	            'content'=>$content,
	            'parentid'=>0,
	            'datetime'=>$datetime,
	            'templeid'=>$templeid,
	            'location'=>$location);
	        $this->wishboard_mdl->add($param);
		    if($this->session->userdata('username') != '')
		    	redirect('user/home/order/'.$donation_order_id,'refresh');
		    else
		    	redirect('checkout/success/'.$donation_order_id,'refresh');
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    //如要调试，请看alipay_notify.php页面的verifyReturn函数
		    echo "Fail";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */