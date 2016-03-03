<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Auth
{
	private $ci;

    public function __construct()
    {
        // 获取CI句柄
		$this->ci =& get_instance();
		$this->ci->load->model('user_mdl');
		
    }
	
    // 判断用户是否已经登录 
	public function logged_in()
	{
		if($this->ci->session->userdata('usertype') != null)
			return (bool)$this->ci->session->userdata('username');
		else
			return FALSE;
	}

	//登录
	public function login($username,$password)
	{
		if($this->ci->user_mdl->login($username,$password))
		{
			return TRUE;
		}
		//var_dump($this->ci->user_mdl->login($username,$password));
		//exit();
		return FALSE;
	}
	
	public function check_permit($page){
		
		//验证用户登录、页面权限		
		if(!$this->check_ip($this->ci->input->ip_address()))
		{
			show_error('禁止访问:您当前的IP地址不合法');
			redirect('admin/login','refresh');
			exit(1);
		}

		if(!$this->logged_in())
		{
			redirect('admin/login','refresh');
			exit(1);
		}
		if(!$this->is_permit($this->ci->session->userdata('username'),$page))
		{
			show_error('禁止访问:不具有该权限');
			redirect('admin','refresh');
			exit(1);
		}
	}
	
	//退出
	public function logout()
	{
		$this->ci->session->unset_userdata('username');
		$this->ci->session->sess_destroy();
	}

	//检测该用户是否具有访问该页面的权限
	public function is_permit($username,$page)
	{
		if($this->is_admin($username))
		{
			return TRUE;
		}
		else if($this->ci->user_mdl->check_permit($username,$page))
		{
			return TRUE;
		}
		return FALSE;
	}

	//检测该用户是否是管理员
	public function is_admin($username)
	{
		if($this->ci->user_mdl->admin($username))
		{
			return TRUE;
		}
		return FALSE;
	}
}
	