<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '寺院规划 - 寺院规划';
		$this->load->model('temple_mdl');
		$this->data['temple_nav'] = 'donation';
	}

	public function index()
	{	
		$this->data['temple'] = $this->temple_mdl->info($this->session->userdata('templeid'));
		$this->load->view('plan', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */