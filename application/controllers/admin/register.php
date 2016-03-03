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
		if(!$this->auth->logged_in() || !$this->auth->is_admin($this->session->userdata('username')))
		{
			redirect('login','refresh');
		}
		$this->load->model('data_mdl');
		$this->data['title'] = '智慧寺院 - 注册管理';
		$this->data['nav'] = 'manage';
		$this->data['nav_info'] = '管理后台';
		$this->data['sidebar'] = 'register';
	}

	public function index()
	{	
		$this->data['register'] = $this->data_mdl->get_register();
		$this->load->view('admin/register', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */