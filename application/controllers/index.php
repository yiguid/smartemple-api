<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

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
		$this->data['title'] = '智慧寺院';
		$this->data['nav'] = 'index';
		$this->load->model('temple_mdl');
		$this->load->model('donation_mdl');
	}

	public function index()
	{	
		//$this->data['temple'] = $this->temple_mdl->get();
		//$this->load->view('portal/index', $this->data);
		//redirect('visit', 'refresh');
		$this->data['nav_info'] = '开启智慧弘法新时代';
		$this->session->sess_destroy();
		//$this->load->view('index', $this->data);
		$this->load->view('v1_index', $this->data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */