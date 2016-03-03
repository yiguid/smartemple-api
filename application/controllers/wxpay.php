<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wxpay extends CI_Controller {

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
		require_once(APPPATH."third_party/wxpay/WxPay.Api.php");
		require_once(APPPATH."third_party/wxpay/WxPay.NativePay.php");
		require_once(APPPATH."third_party/wxpay/WxPay.JsApiPay.php");
		require_once(APPPATH."third_party/wxpay/WxPay.Notify.php");
		require_once(APPPATH."third_party/wxpay/Smartemple.Notify.php");
		$this->data['title'] = '微信支付';
		$this->data['nav'] = 'donation';
		$this->load->model('qrcode_mdl');
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
		redirect('wxpay/jsapi','refresh');
	}

	public function native($templeid, $donationid)
	{	
		$notify = new NativePay();
		$input = new WxPayUnifiedOrder();
		$input->SetBody("普光寺");
		$input->SetAttach("释迦牟尼佛");
		$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee("1");
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("佛像");
		$input->SetNotify_url("http://www.smartemple.com/wxpay/native_notify/");
		$input->SetTrade_type("NATIVE");
		$input->SetProduct_id($donationid);
		$result = $notify->GetPayUrl($input);
		var_dump($result);
		$url = $result["code_url"];
		$donation_wxpay_qrcode = $this->qrcode_mdl->get_donation_wxpay_qrcode($templeid,$donationid,$url);
		echo '<img src="'.$donation_wxpay_qrcode.'" />';
	}

	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		$notfiyOutput = array();
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		return true;
	}

	public function native_notify()
	{
		$notify = new PayNotifyCallBack();
		$notify->Handle(false);
	}

	//打印输出数组信息
	public function printf_info($data)
	{
	    foreach($data as $key=>$value){
	        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
	    }
	}

	public function jsapi()
	{
		//①、获取用户openid
		$tools = new JsApiPay();
		$openId = $tools->GetOpenid();
		//②、统一下单
		$input = new WxPayUnifiedOrder();
		$input->SetBody("智慧寺院供养订单");
		$input->SetAttach("微信支付");
		$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee($this->cart->total() * 100); //单位是分
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("智慧寺院");
		$input->SetNotify_url("http://www.smartemple.com/wxpay/jsapi_notify/");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$order = WxPayApi::unifiedOrder($input);
		//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
		//$this->printf_info($order);
		$this->data['jsApiParameters'] = $tools->GetJsApiParameters($order);
		//var_dump($jsApiParameters);
		//获取共享收货地址js函数参数
		$this->data['editAddress'] = $tools->GetEditAddressParameters();
		//var_dump($editAddress);
		$this->load->view('wxpay/jsapi',$this->data);
	}

	public function success()
	{
		if($this->session->userdata('wxpay')){
			//支付成功
			$donation_order_id = $this->session->userdata('donation_order_id');
			$this->donation_mdl->update_order($donation_order_id, array('status' => '支付成功'));
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

		    //销毁购物车
			//重置购物车和order session
		    $this->session->set_userdata('donation_order_id','');
			$this->cart->destroy();
			$this->session->set_userdata('wxpay',false);
		    if($this->session->userdata('username') != '')
		    	redirect('user/home/order/'.$donation_order_id,'refresh');
		    else
		    	redirect('checkout/success/'.$donation_order_id,'refresh');
			//echo 'success';
		}else
			redirect('wxpay/fail','refresh');
	}

	public function fail()
	{
		echo 'failed!';
	}

	public function jsapi_notify()
	{
		$notify = new PayNotifyCallBack();
		$notify->Handle(false);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */