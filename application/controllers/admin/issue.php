<?php 
error_reporting(E_ALL || ~E_NOTICE);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issue extends CI_Controller {

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
		$this->load->model('message_mdl');
		$this->data['title'] = '智慧寺院 - 消息发布';
		$this->data['nav'] = 'manage';
		$this->data['nav_info'] = '管理后台';
		$this->data['sidebar'] = 'message';
	}

	public function index()
	{	
		$this->load->view('admin/issue', $this->data);				
	}
}
?>