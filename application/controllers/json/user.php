<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_user_mdl');
		$this->load->model('accesstoken_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function donation()
	{		
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$userid = $this->input->get('userid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$user_list = $this->json_user_mdl->donation_get($userid,$page,$limit);	
		}
		else
			$user_list = array('code'=>-1,'msg'=>'error');
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function donation_zhongchou()
	{	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$userid = $this->input->get('userid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$user_list = $this->json_user_mdl->donation_zhongchou_get($userid,$page,$limit);
		}
		else
			$user_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function wish()
	{	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$userid = $this->input->get('userid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$user_list = $this->json_user_mdl->wish_get($userid,$page,$limit);
		}
		else
			$user_list = array('code'=>-1,'msg'=>'error');		
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function activity()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$userid = $this->input->get('userid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$user_list = $this->json_user_mdl->activity_get($userid,$page,$limit);	
		}
		else
			$user_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function volunteer()
	{				
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$userid = $this->input->get('userid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$user_list = $this->json_user_mdl->volunteer_get($userid,$page,$limit);	
		}
		else
			$user_list = array('code'=>-1,'msg'=>'error');
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";	
	}

	public function info()
	{					
		$userid = $this->input->get('userid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$user_list = $this->json_user_mdl->info_get($userid);
		}
		else
			$user_list = array('code'=>-1,'msg'=>'error');
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";	
	}

	public function update()
	{
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules('password','密码','trim');
		$this->form_validation->set_rules('realname','真实姓名','required|trim');
		if($this->form_validation->run() == FALSE){
			$this->data['home_nav'] = 'setting';
			$this->data['user'] = $this->json_user_mdl->info_get($id);
			$this->load->view('user/home/setting',$this->data);
		}else{
			if($this->input->post('password') != ''){
				$user = array(
					'password' => $this->input->post('password'),
					'realname' => $this->input->post('realname')
				);
			}else{
				$user = array(
					'realname' => $this->input->post('realname')
				);
			}
			$this->json_user_mdl->update($id,$user);
			$this->session->set_userdata('realname',$this->input->post('realname'));
			redirect('user/home/setting');
		}
	}

	public function update_detail()
	{
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules('gender','性别','trim');
		$this->form_validation->set_rules('age','年龄','trim');
		$this->form_validation->set_rules('idcard','身份证号','trim|min_length[10]|max_length[18]|xss_clean');
		$this->form_validation->set_rules('mobile','手机号','trim|min_length[11]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('email','邮箱','valid_email|trim');
		if($this->form_validation->run() == FALSE){
			$this->data['home_nav'] = 'setting';
			$this->data['user'] = $this->json_user_mdl->info_get($id);
			$this->load->view('user/home/setting',$this->data);
		}else{
			$user = array(
				'gender' => $this->input->get('gender'),
				'age' => $this->input->get('age'),
				'idcard' => $this->input->get('idcard'),
				'mobile' => $this->input->get('mobile'),
				'company' => $this->input->get('company'),
				'job' => $this->input->get('job'),
				'qq' => $this->input->get('qq'),
				'weixin' => $this->input->get('weixin'),
				'email' => $this->input->get('email'),
				'address' => $this->input->get('address'),
				'minzu' => $this->input->get('minzu'),
				'xueli' => $this->input->get('xueli'),
				'hunfou' => $this->input->get('hunfou'),
				'guiyifou' => $this->input->get('guiyifou'),
				'guiyitime' => $this->input->get('guiyitime'),
				'more' => $this->input->get('more')
			);
			$this->json_user_mdl->update_detail($id,$user);
			$this->session->set_userdata('userdetail',true);
			redirect('user/home/setting');
		}
	}

	private function json_unescaped_unicode($str)
	{
		return preg_replace_callback(
	            "#\\\u([0-9a-f]{4})#i",
	            function($matchs)
	            {
	                 return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
	            },
	             $str
	            );
	}
}
?>