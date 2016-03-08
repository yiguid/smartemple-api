<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

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
		$this->load->model('json_register_mdl');
	}

	public function r()
	{    		
		 echo "<script language='javascript' src='".base_url()."assets/js/visi.js'>commit_mobile('".base_url()."');</script>";
	}

	public function ajax_commit_mobile()
	{
		//$mobile
		extract($_REQUEST);
		//如果该手机号已注册
		if($this->json_register_mdl->exist($mobile)){
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
			if($this->json_register_mdl->exist($mobile)){
				$this->json_register_mdl->login_with_username($mobile);
			}
			//如果没有，注册后登录
			else{
				$user = array('username' => $mobile,'password'=> $mobile,
							  'realname' => substr_replace($mobile,'****',3,4), 'type' => 'user','templeid' => $this->session->userdata('page_templeid'),'registtime' => date("Y-m-d H:i:s"));
				$this->json_register_mdl->regist($user);
				$this->json_register_mdl->login_with_username($mobile);
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
		if($this->json_register_mdl->exist($mobile)){
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
			if($this->json_register_mdl->exist($mobile)){
				$this->json_register_mdl->login_with_username($mobile);
			}
			echo true;
		}
		else
			echo false;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */