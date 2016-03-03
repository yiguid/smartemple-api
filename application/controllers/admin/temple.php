<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temple extends CI_Controller {

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
		$this->load->model('temple_mdl');
		$this->load->model('donation_mdl');
		$this->data['title'] = '智慧寺院 - 寺院管理';
		$this->data['nav'] = 'manage';
		$this->data['nav_info'] = '管理后台';
		$this->data['sidebar'] = 'temple';
	}

	public function index()
	{	
		$this->data['temple'] = $this->temple_mdl->get();
		$this->load->view('admin/temple', $this->data);
	}

	public function add()
	{
		$this->form_validation->set_rules('name','名称','required|trim');
		$this->form_validation->set_rules('englishname','英文名','required|trim');
		$this->form_validation->set_rules('province','省份','required|trim');
		$this->form_validation->set_rules('city','城市','required|trim');
		$this->form_validation->set_rules('master','住持','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/temple_add',$this->data);
		}else{
			$name = $this->input->post('name');
			$englishname = $this->input->post('englishname');
			$province = $this->input->post('province');
			$city = $this->input->post('city');
			$master = $this->input->post('master');
			$templeid = $this->temple_mdl->add(array('name' => $name,'englishname' => $englishname,'province' => $province,'city' => $city,'master' => $master));
			//添加基础的供养物
			$this->donation_mdl->insert_default_data($templeid);
			redirect('admin/temple','refresh');
		}
	}

	public function edit($id)
	{	
		$this->data['entry'] = $this->temple_mdl->info($id);
		$this->form_validation->set_rules('name','名称','required|trim');
		$this->form_validation->set_rules('englishname','英文名','required|trim');
		$this->form_validation->set_rules('province','省份','required|trim');
		$this->form_validation->set_rules('city','城市','required|trim');
		$this->form_validation->set_rules('master','住持','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/temple_edit',$this->data);
		}else{
			$name = $this->input->post('name');
			$englishname = $this->input->post('englishname');
			$province = $this->input->post('province');
			$city = $this->input->post('city');
			$master = $this->input->post('master');
			$this->temple_mdl->update($id, array('name' => $name,'englishname' => $englishname,'province' => $province,'city' => $city,'master' => $master));
			redirect('admin/temple','refresh');
		}
	}

	public function delete($id)
	{
		$income = $this->donation_mdl->get_temple_order_income($id);
		if($income->income == 0){
			$this->temple_mdl->delete($id);
			$this->data['delete_temple_info'] = '删除成功';
		}
		else
			$this->data['delete_temple_info'] = '该寺院有已经支付的供养，不能删除，请联系后台管理员。';
		$this->data['temple'] = $this->temple_mdl->get();
		$this->load->view('admin/temple', $this->data);
	}

	public function id($id)
	{
		$this->data['entry'] = $this->temple_mdl->info($id);
		$this->data['master'] = $this->temple_mdl->get_master($id);
		$this->load->view('admin/temple_info',$this->data);
	}

	public function stick($id,$pos)
	{
		if($pos == 0)
			$this->temple_mdl->update($id,array('pos' => 1));
		else
			$this->temple_mdl->update($id,array('pos' => 0));
		redirect('admin/temple','refresh');
	}

	public function add_master($id)
	{
		$this->data['entry'] = $this->temple_mdl->info($id);
		$this->data['master'] = $this->temple_mdl->get_master($id);
		$this->form_validation->set_rules('username','用户名','required|trim');
		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/temple_info',$this->data);
		}else{
			$username = $this->input->post('username');
			if(!$this->user_mdl->exist($username))
				$this->data['add_master_info'] = '用户名不存在';
			else if(!$this->user_mdl->is_master($username))
				$this->data['add_master_info'] = '该用户不符合要求';
			else
				$this->data['add_master_info'] = $this->temple_mdl->add_master($id,$username);
			$this->data['master'] = $this->temple_mdl->get_master($id);
			$this->load->view('admin/temple_info',$this->data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */