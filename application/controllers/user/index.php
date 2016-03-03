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
		$this->data['title'] = '主页 - 智慧寺院';
		$this->data['nav'] = 'index';
		$this->load->model('donation_mdl');
		$this->load->model('activity_mdl');
		$this->load->model('news_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('user_mdl');
		$this->load->model('wishboard_mdl');
		$templeid = $this->session->userdata('templeid');
		$this->data['temple'] = $this->temple_mdl->info($templeid);
	}

	public function index()
	{
		//redirect('user/order','refresh');
		$id_arr = array();
		$this->data['news_list'] = $this->news_mdl->get_index(array(), 3, -1);
		$this->data['news1_list'] = $this->news_mdl->get_rec(1, 1); //typeid==1
		$this->data['news2_list'] = $this->news_mdl->get_rec(2, 4); //typeid==2
		$this->data['news3_list'] = $this->news_mdl->get_rec(3, 4); //typeid==3
		$this->data['activity_list'] = $this->activity_mdl->get_index(array(), 2);
		$this->data['qf_list'] = $this->wishboard_mdl->get_index(array(), 10);
		$this->data['roll_list'] = $this->donation_mdl->get_recent_roll(array(),1,TRUE);
		//$this->load->view('user/index',$this->data);
		// $this->date['news_mdl']=$this->news_mdl->get();
		$this->load->view('user/v1_index',$this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */