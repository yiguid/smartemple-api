<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
		if(!$this->auth->logged_in() || !$this->auth->is_admin($this->session->userdata('username')))
		{
			redirect('login','refresh');
		}
		$this->load->model('user_mdl');
		$this->data['title'] = '智慧寺院 - 用户管理';
		$this->data['nav'] = 'manage';
		$this->data['nav_info'] = '管理后台';
		$this->data['sidebar'] = 'user';
	}

	public function index()
	{	
		$this->data['user'] = $this->user_mdl->get();
		$this->load->view('admin/user', $this->data);
	}

	public function add()
	{
		$this->form_validation->set_rules('username','用户名','alpha_dash|min_length[4]|max_length[15]|trim|required|min_length[4]|max_length[15]|xss_clean');
		$this->form_validation->set_rules('password','密码','alpha_dash|min_length[6]|max_length[20]|required|trim');
		$this->form_validation->set_rules('realname','真实姓名','required|trim');
		$this->form_validation->set_rules('type','类别','alpha|required|trim');
		$this->form_validation->set_rules('templeid','寺院ID','numeric|required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/user_add',$this->data);
		}else{
			$user = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'realname' => $this->input->post('realname'),
				'type' => $this->input->post('type'),
				'templeid' => $this->input->post('templeid'),
				'registtime' => date("Y-m-d H:i:s")
			);
			if(!$this->user_mdl->exist($user['username']))
				$this->user_mdl->add($user);
			redirect('admin/user');
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('username','alpha_dash|min_length[4]|max_length[15]|trim|required|min_length[4]|max_length[15]|xss_clean');
		$this->form_validation->set_rules('password','密码','alpha_dash|min_length[6]|max_length[20]|required|trim');
		$this->form_validation->set_rules('realname','真实姓名','required|trim');
		$this->form_validation->set_rules('type','类别','alpha|required|trim');

		if($this->form_validation->run() == FALSE){
			$this->data['entry'] = $this->user_mdl->info($id);
			$this->load->view('admin/user_edit',$this->data);
		}else{
			//编辑
			$user = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
					'realname' => $this->input->post('realname'),
					'type' => $this->input->post('type')
				);
			$this->user_mdl->update($id,$user);
			redirect('admin/user','refresh');
		}
	}

	public function delete($id)
	{
		$this->user_mdl->delete($id);
		redirect('admin/user','refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */