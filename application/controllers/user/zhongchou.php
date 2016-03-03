<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class zhongchou extends CI_Controller {
	public $data = array();
	public $templeid;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('zhongchou_mdl');
		$this->load->model('reward_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('wishboard_mdl');
        $this->load->model('iptool_mdl');
		$this->load->model('data_mdl');
		$this->data['nav'] = 'donation';
		$this->data['sidebar'] = 'zhongchou';

		//APPPATH.
		require_once(APPPATH."third_party/alipay/alipay_submit.class.php");
		require_once(APPPATH."third_party/alipay/alipay_notify.class.php");
		// 加载支付宝配置
    	$this->config->load('alipay', TRUE);
	}
	
	public function index()
	{
		//$this->data['zhongchou_list'] = $this->zhongchou_mdl->get(1,$this->templeid);
		$this->load->view('user/zhongchou/index',$this->data);
	}

	public function ilike(){
		extract($_REQUEST);
		$this->data['zhongchou'] = $this->zhongchou_mdl->info($id);
		//增加喜爱
		$this->zhongchou_mdl->update($id,array('like' => $this->data['zhongchou']->like + 1));
	}

	public function id($id)
	{
		$this->data['zhongchou'] = $this->zhongchou_mdl->info($id);
		if($this->data['zhongchou'] == null)
			show_404();
		//增加阅读量
		$this->zhongchou_mdl->add_views($id,$this->data['zhongchou']->views + 1);
		$this->data['reward_list'] = $this->reward_mdl->get($id);
		$this->data['temple'] = $this->temple_mdl->info($this->data['zhongchou']->founderid);
		$this->data['donator_list']  = $this->zhongchou_mdl->get_donator_list($id);
		$total_money = 0;
		$support_count = array();

		//初始化每个reward的捐助人数为0
		foreach ($this->data['reward_list'] as $reward) {
			$support_count[$reward->id] = 0;
		}

		//遍历已捐助的清单
		foreach ($this->data['donator_list'] as $donator) {
			//获得总支持的金额
			$total_money += $donator->money;
			//获得每个捐助项目支持的人数
			$support_count[$donator->rewardid] ++;
			//变换时间
			$donator->recordtime = $this->data_mdl->time_tran($donator->recordtime);
		}

		$this->data['support_count'] = $support_count;
		$this->data['total_money'] = $total_money;
		$this->session->set_userdata('jump_from','user/zhongchou/id/'.$id);
		$this->load->view('user/zhongchou_info',$this->data);
	}

	// 检测是否登陆，登陆后获取rewardid传给support方法
	public function support($rewardid)
	{
		if(!$this->auth->logged_in())
		{
			redirect('login','refresh');
		}
		$reward = $this->reward_mdl->info($rewardid);
		$userid = $this->session->userdata('id');
		//调用支持接口发起支付

		//支付成功后更新
		$this->zhongchou_mdl->support($userid,$rewardid);
		redirect('user/zhongchou/id/'.$reward->zhongchouid,'refresh');
	}

	public function alipay($rewardid)
	{
		$recordtime = date("Y-m-d H:i:s",time());
		$recordid = "Z".date("YmdHis").substr(md5($recordtime),0,6);
		$this->session->set_userdata('zhongchou_recordid',$recordid);
		//生成订单
		$data = array('id'=>$recordid,'userid'=>$this->session->userdata('id'),'rewardid'=>$rewardid,'recordtime'=>$recordtime,'status'=>'未支付');
		$this->zhongchou_mdl->add_record($data);
		//开始支付
		$reward = $this->reward_mdl->info($rewardid);
		//支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = base_url()."user/zhongchou/alipay_notify_process";
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = base_url()."user/zhongchou/alipay_return_process";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户
        $seller_email = 'irockwill@163.com';
        //必填
        //商户订单号
        $out_trade_no = $this->session->userdata('zhongchou_recordid');
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = "智慧寺院众筹订单";
        //必填
        //付款金额
        $total_fee = $reward->money;
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

	public function alipay_notify_process()
	{
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($this->config->item('alipay'));
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功

		//商户订单号
		$input = $this->input->post();
		$out_trade_no = $input['out_trade_no'];

		//支付宝交易号

		$trade_no = $input['trade_no'];

		//交易状态
		$trade_status = $input['trade_status'];


	    if($input['trade_status'] == 'TRADE_FINISHED') {
			//判断该笔订单是否在商户网站中已经做过处理
	    }
	    else if ($input['trade_status'] == 'TRADE_SUCCESS') {
			//判断该笔订单是否在商户网站中已经做过处理
	    }

		//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	    $recordid = $out_trade_no;
	    $this->session->set_userdata('zhongchou_recordid','');
	    //更新支付成功
	    $this->zhongchou_mdl->update_record($recordid,array('status' => '支付成功'));
	    $zhongchou_record = $this->zhongchou_mdl->info_record($recordid);
	    $reward = $this->reward_mdl->info($zhongchou_record->rewardid);
	    $zhongchou = $this->zhongchou_mdl->info($reward->zhongchouid);
	    //发布一条供养成功的祈福消息
        $content = "虔诚援助".$zhongchou->title."".$reward->money."元。功德无量，阿弥陀佛！";
        $datetime = date("Y-m-d H:i:s");
        $templeid = $zhongchou->founderid;
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
	    redirect('user/zhongchou/id/'.$zhongchou->id,'refresh');    
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

	public function alipay_return_process()
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
		   	$recordid = $out_trade_no;
		    $this->session->set_userdata('zhongchou_recordid','');
		    //更新支付成功
		    $this->zhongchou_mdl->update_record($recordid,array('status' => '支付成功'));
		    $zhongchou_record = $this->zhongchou_mdl->info_record($recordid);
		    $reward = $this->reward_mdl->info($zhongchou_record->rewardid);
		    $zhongchou = $this->zhongchou_mdl->info($reward->zhongchouid);
		    //发布一条供养成功的祈福消息
	        $content = "虔诚援助".$zhongchou->title."".$reward->money."元。功德无量，阿弥陀佛！";
	        $datetime = date("Y-m-d H:i:s");
	        $templeid = $zhongchou->founderid;
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
		    redirect('user/zhongchou/id/'.$zhongchou->id,'refresh');    
			echo "success";		//请不要修改或删除
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    //如要调试，请看alipay_notify.php页面的verifyReturn函数
		    echo "Fail";
		}
	}
}
?>