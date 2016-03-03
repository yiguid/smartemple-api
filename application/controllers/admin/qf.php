<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qf extends CI_Controller {
    public $data = array();
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->logged_in() || !$this->auth->is_admin($this->session->userdata('username')))
		{
			redirect('login','refresh');
		}
		$this->data['page_title'] = '祈福墙';

		$this->load->model('wishboard_mdl');
        $this->load->model('temple_mdl');
        $this->load->model('iptool_mdl');
        $this->data['nav'] = 'qf';
		$this->data['nav_info'] = '管理后台';
        $this->data['title'] = '祈福墙';
	}

	public function index()
	{
		$this->data['temple'] = $this->temple_mdl->get();
        $this->data['crumb'] = array(array('name'=> '智慧祈福','url'=>'qf','active'=>'active'));
		$this->load->view('admin/qf',$this->data);
	}

	public function recent($templeid = 0)
	{
		$this->data['qf'] = $this->wishboard_mdl->get_recent($templeid);
		$this->load->view('admin/qf_recent',$this->data);
	}

	public function delete($id)
	{
		$this->wishboard_mdl->delete($id);
		redirect('admin/qf/recent','refresh');
	}
}
