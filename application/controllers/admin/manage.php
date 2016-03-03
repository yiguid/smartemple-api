<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller {

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
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'admin')
		{
			redirect('login','refresh');
		}
		$this->load->model('user_mdl');
		$this->load->model('data_mdl');
		$this->data['title'] = '智慧寺院 - 寺院管理';
		$this->data['nav'] = 'manage';
		$this->data['nav_info'] = '管理后台';
		$this->data['sidebar'] = 'index';
	}

	public function index()
	{	
		$this->data['user_num'] = $this->data_mdl->get_count('user');
		$this->data['temple_num'] = $this->data_mdl->get_count('temple');
		$this->data['space_num'] = $this->data_mdl->get_count('space');
		$this->data['donation_num'] = $this->data_mdl->get_count('donation');
		$this->data['register_num'] = $this->data_mdl->get_count('register');
		$this->load->view('admin/manage', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */