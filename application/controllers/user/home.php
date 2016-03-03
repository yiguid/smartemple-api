<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->logged_in())
		{
			redirect('login','refresh');
		}
		$this->data['title'] = '个人中心 - 智慧寺院';
		$this->data['nav'] = 'user';
		$this->data['nav_info'] = '个人中心';
		$this->load->model('donation_mdl');
		$this->load->model('activity_mdl');
		$this->load->model('volunteer_mdl');
		$this->load->model('question_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('wishboard_mdl');
		$this->load->model('reward_mdl');
		$this->load->model('zhongchou_mdl');
		$this->load->model('user_mdl');
	}

	public function index()
	{
		$this->data['home_nav'] = 'setting';
		$this->data['user'] = $this->user_mdl->info($this->session->userdata('id'));
		$this->load->view('user/home/setting',$this->data);
	}

	public function order($orderid = '')
	{	
		$this->data['home_nav'] = 'order';
		if($orderid == ''){
			$this->data['order'] = $this->donation_mdl->get_order($this->session->userdata('username'),0);
			$this->data['zhongchou'] = $this->reward_mdl->get_history($this->session->userdata('id'));
			$this->load->view('user/home/order', $this->data);
		}
		else{
			$this->data['order_items'] = $this->donation_mdl->get_order_items($orderid);
			$this->data['order'] = $this->donation_mdl->get_order_info($orderid);
			$this->load->view('user/home/order_items',$this->data);
		}
	}

	public function activity()
	{
		$this->data['home_nav'] = 'activity';
		$this->data['activity_list'] = $this->activity_mdl->get_by_user($this->session->userdata('id'));
		$this->load->view('user/home/home_activity',$this->data);
	}

	public function volunteer()
	{
		$this->data['home_nav'] = 'volunteer';
		$this->data['volunteer_list'] = $this->volunteer_mdl->get_by_user($this->session->userdata('id'));
		$this->load->view('user/home/home_volunteer',$this->data);
	}

	public function volunteer_answer($id)
	{
		$this->data['home_nav'] = 'volunteer';
		//获取义工信息，注册信息，问卷填写信息，问卷原始信息和问卷选项
		$this->data['volunteer'] = $this->volunteer_mdl->info($id);
		$this->data['register'] = $this->volunteer_mdl->get_register_by_user($id,$this->session->userdata('id'));
		$this->data['answer_list'] = $this->volunteer_mdl->get_register_answer($this->data['register']->id);
		$this->data['question_list'] = $this->question_mdl->get();
		$this->data['option_list'] = $this->question_mdl->get_option();
		$this->load->view('user/home/home_volunteer_answer',$this->data);
	}

	public function u_message()
	{
		$this->data['home_nav'] = 'qf';
		$this->data['qf_list'] = $this->message_mdl->u_message($this->session->userdata('id'),1);
		$this->data['cur_page'] = 1;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->message_mdl->get_page($this->session->userdata('id'));		
		$this->load->view('user/home/home_qf',$this->data);
	}

	public function issue($username)
	{		
		$this->data['home_nav'] = 'qf';				
		$this->data['username'] = $username;
		$this->load->view('user/home/home_issue',$this->data);	
	}

	public function data_issue()
	{
		$this->data['home_nav'] = 'qf';
		$username = $this->input->post('username');
		$content = $this->input->post('editorValue');		
		$this->data['msg'] = $this->message_mdl->data_issue($username,strip_tags($content));
		$this->data['qf_list'] = $this->message_mdl->u_message($this->session->userdata('id'),1);
		$this->data['cur_page'] = 1;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->message_mdl->get_page($this->session->userdata('id'));		
		$this->load->view('user/home/home_qf',$this->data);
	}

	public function delete($id)
	{
		$this->data['home_nav'] = 'qf';
		$this->message_mdl->delete_ms($id);		
		$this->data['qf_list'] = $this->message_mdl->u_message($this->session->userdata('id'),1);
		$this->data['cur_page'] = 1;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->message_mdl->get_page($this->session->userdata('id'));		
		$this->load->view('user/home/home_qf',$this->data);
	}

	public function page($page)
	{
		if($page < 1)
			$page = 1;
		$this->data['home_nav'] = 'qf';
		$this->data['qf_list'] = $this->message_mdl->u_message($this->session->userdata('id'),$page); 
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->message_mdl->get_page($this->session->userdata('id'));
		$this->load->view('user/home/home_qf',$this->data);
	}

	public function setting()
	{
		$this->data['home_nav'] = 'setting';
		$this->data['user'] = $this->user_mdl->info($this->session->userdata('id'));
		$this->load->view('user/home/setting',$this->data);
	}

	public function update()
	{
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules('password','密码','trim');
		$this->form_validation->set_rules('realname','真实姓名','required|trim');
		if($this->form_validation->run() == FALSE){
			$this->data['home_nav'] = 'setting';
			$this->data['user'] = $this->user_mdl->info($id);
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
			$this->user_mdl->update($id,$user);
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
			$this->data['user'] = $this->user_mdl->info($id);
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
			$this->user_mdl->update_detail($id,$user);
			$this->session->set_userdata('userdetail',true);
			redirect('user/home/setting');
		}
	}
}