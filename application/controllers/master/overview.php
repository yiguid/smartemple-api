<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overview extends CI_Controller {

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
		$this->data['title'] = '智慧寺院';
		$this->data['nav'] = 'index';
		$this->data['temple'] = $this->temple_mdl->info($this->session->userdata('templeid'));
		$this->data['nav_info'] = $this->data['temple']->name;
		$this->load->model('data_mdl');
	}

	public function index()
	{	
		redirect('master/news','refresh');
		// $templeid = $this->session->userdata('templeid');
		// $this->data['temple'] = $this->temple_mdl->info($templeid);
		// $this->data['space'] = $this->data_mdl->get_count_by_templeid('space',$templeid);
		// $this->data['donation'] = $this->data_mdl->get_count_by_templeid('donation',$templeid);
		// $this->data['qf'] = $this->data_mdl->get_count_by_templeid('wishboard',$templeid);
		// $this->load->view('master/overview', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */