<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('json_register_mdl');
		$this->load->model('sms_mdl');
		$this->load->model('accesstoken_mdl');
		header('content-type:application/json;charset=utf8'); 
	}

	public function vcode_commit()
	{
		$mobile = $this->input->post('phone');			
		if($this->json_register_mdl->exist($mobile)){			
			echo 1;       return ;             //如果该手机号已注册
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

	public function register_commit()
	{		
		$captcha = $this->input->post('vcode');
		$mobile = $this->session->userdata('mobile');		
		if($this->session->userdata('captcha') != $captcha)
		{
			echo 3;  return ;        //验证码不正确
		}
		else if($this->user_mdl->exist($mobile))
		{
			echo 2;  return ;        //用户名已存在			
		}			
		$user = array('username' => $mobile,'password'=> $mobile,'realname' => substr_replace($mobile,'****',3,4), 'type' => 'user','templeid' => $this->session->userdata('page_templeid'),'registtime' => date("Y-m-d H:i:s"));
		if($this->json_register_mdl->add($user))
		{
			echo 1;  return ;       //注册成功
		}             					
	}

}
