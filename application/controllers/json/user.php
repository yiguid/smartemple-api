<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_user_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function donation($id,$page = 1,$num_per_page = 10)
	{		
		$user_list = $this->json_user_mdl->donation_get($id,$page,$num_per_page);	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function donation_zhongchou($id,$page = 1,$num_per_page = 10)
	{	
		$user_list = $this->json_user_mdl->donation_zhongchou_get($id,$page,$num_per_page);	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function wish($id,$page = 1,$num_per_page = 10)
	{	
		$user_list = $this->json_user_mdl->wish_get($id,$page,$num_per_page);	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function activity($id,$page = 1,$num_per_page = 10)
	{
		$user_list = $this->json_user_mdl->activity_get($id,$page,$num_per_page);	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function volunteer($id,$page = 1,$num_per_page = 10)
	{				
		$user_list = $this->json_user_mdl->volunteer_get($id,$page,$num_per_page);	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";	
	}

	public function setting($id)
	{				
		$user_list = $this->json_user_mdl->info($id);
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";	
	}

	public function update()
	{
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules('password','密码','trim');
		$this->form_validation->set_rules('realname','真实姓名','required|trim');
		if($this->form_validation->run() == FALSE){
			$this->data['home_nav'] = 'setting';
			$this->data['user'] = $this->json_user_mdl->info($id);
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
			$this->data['user'] = $this->json_user_mdl->info($id);
			$this->load->view('user/home/setting',$this->data);
		}else{
			$user = array(
				'gender' => $this->input->post('gender'),
				'age' => $this->input->post('age'),
				'idcard' => $this->input->post('idcard'),
				'mobile' => $this->input->post('mobile'),
				'company' => $this->input->post('company'),
				'job' => $this->input->post('job'),
				'qq' => $this->input->post('qq'),
				'weixin' => $this->input->post('weixin'),
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
				'minzu' => $this->input->post('minzu'),
				'xueli' => $this->input->post('xueli'),
				'hunfou' => $this->input->post('hunfou'),
				'guiyifou' => $this->input->post('guiyifou'),
				'guiyitime' => $this->input->post('guiyitime'),
				'more' => $this->input->post('more')
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