<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offering extends CI_Controller {

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
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'master')
		{
			redirect('login','refresh');
		}
		$this->load->model('temple_mdl');
		$this->load->model('offering_mdl');
		$this->data['title'] = '智慧寺院 - 供养管理';
		$this->data['nav'] = 'digong';
		$this->data['temple'] = $this->temple_mdl->info($this->session->userdata('templeid'));
		$this->data['nav_info'] = $this->data['temple']->name;
		$this->data['sidebar'] = 'offering';
	}

	public function index()
	{	
		$this->data['offering'] = $this->offering_mdl->get();
		$this->load->view('master/offering', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */