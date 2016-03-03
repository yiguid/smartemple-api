<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Digong extends CI_Controller {

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
		$this->data['title'] = '智慧寺院 - 智慧地宫';
		$this->data['nav'] = 'digong';
		$this->data['nav_info'] = '管理后台';
		$this->load->model('temple_mdl');
		$this->load->model('space_mdl');
	}

	public function index()
	{	
		$this->data['temple'] = $this->temple_mdl->get();
		$this->data['crumb'] = array(array('name'=> '智慧地宫','url'=>'digong','active'=>'active'));
		$this->load->view('admin/digong', $this->data);
	}

	public function temple($templeid)
	{
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['space'] = $this->space_mdl->get($templeid);
		$this->data['crumb'] = array(
			array('name'=> '智慧地宫','url'=>'admin/digong','active'=>''),
			array('name'=> $this->data['temple']->name,'url'=>'','active'=>'active')
			);
		$this->load->view('admin/digong_list',$this->data);
	}

	public function space($spaceid)
	{
		$this->data['space'] = $this->space_mdl->info($spaceid);
		$this->data['temple'] = $this->temple_mdl->info($this->data['space']->templeid);
		$this->data['crumb'] = array(
			array('name'=> '智慧地宫','url'=>'admin/digong','active'=>''),
			array('name'=> $this->data['temple']->name,'url'=>'admin/digong/temple/'.$this->data['temple']->id,'active'=>''),
			array('name'=> $this->data['space']->location,'url'=>'','active'=>'active'),
			);
		$this->load->view('admin/space',$this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */