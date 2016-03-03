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
		$this->load->model('zhongchou_mdl');
		$this->load->model('reward_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('wishboard_mdl');
        $this->load->model('iptool_mdl');
		$this->load->model('data_mdl');
	}

	public function index()
	{
		show_404();
	}

	public function pay($rewardid)
	{
		$recordtime = date("Y-m-d H:i:s",time());
		$recordid = "Z".date("YmdHis").substr(md5($recordtime),0,6);
	    $reward = $this->reward_mdl->info($rewardid);
		$this->session->set_userdata('zhongchou_recordid',$recordid);
		//生成订单
		$data = array('id'=>$recordid,'userid'=>$this->session->userdata('id'),'rewardid'=>$rewardid,'recordtime'=>$recordtime,'status'=>'未支付');
		$this->zhongchou_mdl->add_record($data);
		$item = array(
               'id'      => $reward->id,
               'qty'     => 1,
               'price'   => $reward->money,
               'name'    => $reward->award
            );
		$this->cart->insert($item);
		//开始支付
		redirect('user/wxpay/jsapi','refresh');
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
		$recordid = $this->session->userdata('zhongchou_recordid');
		$zhongchou_record = $this->zhongchou_mdl->info_record($recordid);
	    $reward = $this->reward_mdl->info($zhongchou_record->rewardid);
		//①、获取用户openid
		$tools = new JsApiPay();
		$openId = $tools->GetOpenid();
		//②、统一下单
		$input = new WxPayUnifiedOrder();
		$input->SetBody("智慧寺院众筹订单");
		$input->SetAttach("微信支付");
		$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee($reward->money * 100); //单位是分
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("智慧寺院");
		$input->SetNotify_url("http://www.smartemple.com/user/wxpay/jsapi_notify/");
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
		$this->data['total'] = $reward->money;
		$this->load->view('user/zhongchou_jsapi',$this->data);
	}

	public function success()
	{
		if($this->session->userdata('wxpay')){
			//支付成功
			$recordid = $this->session->userdata('zhongchou_recordid');
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
			$this->session->set_userdata('wxpay',false);
		    redirect('user/zhongchou/id/'.$zhongchou->id,'refresh');    
			//echo 'success';
		}else
			redirect('user/wxpay/fail','refresh');
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