<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visit extends CI_Controller {

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
		$this->data['title'] = '智慧寺院';
		$this->data['nav'] = 'index';
		$this->load->model('temple_mdl');
		$this->load->model('user_mdl');
		$this->load->model('iptool_mdl');
		$this->load->model('sms_mdl');
		$this->load->model('data_mdl');
		$this->load->model('wishboard_mdl');
	}

	public function index()
	{	
		//$this->data['temple'] = $this->temple_mdl->get();
		//清空购物车
		$this->cart->destroy();
		$this->session->sess_destroy();
		$ip_infos = $this->iptool_mdl->GetIpLookup($this->iptool_mdl->GetIp());
		if($ip_infos != 'unknown' && $ip_infos != '127.0.0.1')
			$location = $ip_infos['province'].$ip_infos['city'];
		else
			$location = '北京';
        $this->data['location'] = $location;
        $this->data['temple'] = $this->temple_mdl->get_by_temple_province('浙江');
        $this->data['nav_info'] = '请点击地图选择寺院';
        $this->data['ip_infos'] = $ip_infos;
        $this->data['wish'] = $this->wishboard_mdl->get_recent_by_page(0,20,1);
		$this->load->view('visit/index', $this->data);
	}

	public function register()
	{
    	$this->data['nav_info'] = '新用户注册仅需1秒';
		$this->load->view('visit/v1_register', $this->data);
	}

	public function ajax_commit_mobile()
	{
		//$mobile
		extract($_REQUEST);
		//如果该手机号已注册
		if($this->user_mdl->exist($mobile)){
			echo "{\"code\": 1,\"msg\": \"EXIST\"}";
			return;
		}

		//没有注册
		$str = md5(date('His').$mobile);
		$str = preg_replace('|[a-zA-Z]+|','',$str);
		$captcha = substr($str, 0, 6);
		//测试环境
		//$captcha = '123456';
		//测试环境结束
		$this->session->set_userdata('captcha',$captcha);
		$this->session->set_userdata('mobile',$mobile);
		//发送短信
		//echo $this->sms_mdl->sendTemplateSMS($mobile,array($captcha,'5'),"1");
		//echo md5(date('His'));
		echo $this->sms_mdl->send_sms('1ca6d531984fed9cb4e276990f8c45d1'
							,'【智慧寺院】您的验证码是'.$captcha.'。如非本人操作，请忽略本短信'
							,$mobile);
		//echo "{\"code\": 0,\"msg\": \"OK\",\"result\": {\"count\": 1, \"fee\": 1,  \"sid\": 1097 }}";
	}

	public function ajax_default_commit_mobile()
	{
		//$mobile
		extract($_REQUEST);
		$str = md5(date('His').$mobile);
		$str = preg_replace('|[a-zA-Z]+|','',$str);
		$captcha = substr($str, 0, 6);
		//测试环境
		//$captcha = '123456';
		//测试环境结束
		$this->session->set_userdata('captcha',$captcha);
		$this->session->set_userdata('mobile',$mobile);
		//发送短信
		//echo $this->sms_mdl->sendTemplateSMS($mobile,array($captcha,'5'),"1");
		//echo md5(date('His'));
		echo $this->sms_mdl->send_sms('1ca6d531984fed9cb4e276990f8c45d1'
							,'【智慧寺院】您的验证码是'.$captcha.'。如非本人操作，请忽略本短信'
							,$mobile);
		//echo "{\"code\": 0,\"msg\": \"OK\",\"result\": {\"count\": 1, \"fee\": 1,  \"sid\": 1097 }}";
	}

	public function ajax_verify_mobile()
	{
		extract($_REQUEST);
		$mobile = $this->session->userdata('mobile');
		if($this->session->userdata('captcha') == $captcha && $mobile != ''){
			//查看是否有存在已该手机号为用户名的用户
			//如果有这个手机号的用户，直接的登录
			if($this->user_mdl->exist($mobile)){
				$this->user_mdl->login_with_username($mobile);
			}
			//如果没有，注册后登录
			else{
				$user = array('username' => $mobile,'password'=> $mobile,
							  'realname' => substr_replace($mobile,'****',3,4), 'type' => 'user','templeid' => $this->session->userdata('page_templeid'),'registtime' => date("Y-m-d H:i:s"));
				$this->user_mdl->regist($user);
				$this->user_mdl->login_with_username($mobile);
			}
			echo true;
		}
		else
			echo false;
	}

	public function ajax_resetpwd_commit_mobile()
	{
		//$mobile
		extract($_REQUEST);
		//如果该手机号已注册
		if($this->user_mdl->exist($mobile)){
			$str = md5(date('His').$mobile);
			$str = preg_replace('|[a-zA-Z]+|','',$str);
			$captcha = substr($str, 0, 6);
			//测试环境
			//$captcha = '123456';
			//测试环境结束
			$this->session->set_userdata('captcha',$captcha);
			$this->session->set_userdata('mobile',$mobile);
			//发送短信
			//echo $this->sms_mdl->sendTemplateSMS($mobile,array($captcha,'5'),"1");
			//echo md5(date('His'));
			$this->sms_mdl->send_sms('1ca6d531984fed9cb4e276990f8c45d1'
								,'【智慧寺院】您的验证码是'.$captcha.'。如非本人操作，请忽略本短信'
								,$mobile);
			echo "1";
		}
		else
			echo "0";

		
		//echo "{\"code\": 0,\"msg\": \"OK\",\"result\": {\"count\": 1, \"fee\": 1,  \"sid\": 1097 }}";
	}

	public function ajax_temple_commit_mobile()
	{
		//$mobile
		extract($_REQUEST);
		//如果该手机号未登记寺院
		//测试阶段，一个手机号可以登记多个寺院
		//if(!$this->data_mdl->register_mobile_exist($mobile)){
		if(true){
			$str = md5(date('His').$mobile);
			$str = preg_replace('|[a-zA-Z]+|','',$str);
			$captcha = substr($str, 0, 6);
			//测试环境
			//$captcha = '123456';
			//测试环境结束
			$this->session->set_userdata('captcha',$captcha);
			$this->session->set_userdata('mobile',$mobile);
			//发送短信
			//echo $this->sms_mdl->sendTemplateSMS($mobile,array($captcha,'5'),"1");
			//echo md5(date('His'));
			$this->sms_mdl->send_sms('1ca6d531984fed9cb4e276990f8c45d1'
								,'【智慧寺院】您的验证码是'.$captcha.'。如非本人操作，请忽略本短信'
								,$mobile);
			echo "0";
		}
		else
			echo "1";
		//echo "{\"code\": 0,\"msg\": \"OK\",\"result\": {\"count\": 1, \"fee\": 1,  \"sid\": 1097 }}";
	}

	public function ajax_temple_verify_mobile()
	{
		extract($_REQUEST);
		$mobile = $this->session->userdata('mobile');
		if($this->session->userdata('captcha') == $captcha && $mobile != ''){
			echo true;
		}
		else
			echo false;
	}

	public function ajax_resetpwd_verify_mobile()
	{
		extract($_REQUEST);
		$mobile = $this->session->userdata('mobile');
		if($this->session->userdata('captcha') == $captcha && $mobile != ''){
			//查看是否有存在已该手机号为用户名的用户
			//如果有这个手机号的用户，直接的登录
			if($this->user_mdl->exist($mobile)){
				$this->user_mdl->login_with_username($mobile);
			}
			echo true;
		}
		else
			echo false;
	}

	public function ajax_get_temple()
	{
		extract($_REQUEST);
		//var_dump($this->temple_mdl->get_by_temple_province($province));
		$temple_list = $this->temple_mdl->get_by_temple_province($province);
		$html = "";
		foreach ($temple_list as $t) {
			$html .= "<a class=\"btn btn-buddha-lt btn-visit-temple\" href=\"".
					base_url()."temple/id/".$t->id."\">".$t->name."</a> ";
		}
		if($html == "") //class=\"btn btn-primary\" 
			$html .= "<p>作为第一个开通的寺院？<a class=\"btn btn-buddha-lt\" href=\"".
					base_url()."register\">点击登记</a></p><p>请选择其他省市</p>";
		// else
		// 	$html .= "<br/><p>没有您的所在的寺院？<a class=\"btn btn-info\" href=\"".
		// 			base_url()."register\">点击登记</a></p>";
		echo $html;
	}
	
	public function ajax_get_temple_map()
	{
		$province = array('湖北'=>'hubei','福建'=>'fujian','内蒙古'=>'neimongol'
			,'河南'=>'henan','浙江'=>'zhejiang','黑龙江'=>'heilongjiang','吉林'=>'jilin','辽宁'=>'liaoning'
			,'河北'=>'hebei','山东'=>'shandong','江苏'=>'jiangsu','安徽'=>'anhui'
			,'山西'=>'shanxi','陕西'=>'shaanxi','甘肃'=>'gansu'
			,'江西'=>'jiangxi','湖南'=>'hunan','贵州'=>'guizhou','四川'=>'sichuan','云南'=>'yunnan'
			,'青海'=>'qinghai','海南'=>'hainan','上海'=>'shanghai','重庆'=>'chongqing','天津'=>'tianjin'
			,'北京'=>'beijing','宁夏'=>'ningxia','广西'=>'guangxi','新疆'=>'xinjiang','广东'=>'guangdong'
			,'西藏'=>'xizang','香港'=>'hongkong','台湾'=>'taiwan','澳门'=>'macau');
		$temple_map = $this->temple_mdl->get_temple_map();
		//var_dump($temple_map);
		$data = "{";
		foreach ($temple_map as $tm) {
			if(isset($province[$tm->province]))
				$data .= "'".$province[$tm->province]."':{'stateInitColor':".$tm->total."},";
		}
		rtrim($data, ",");
		$data .= "}";
		echo $data;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */