<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '搜索 - 智慧寺院网';
		$this->data['nav'] = 'index';
		$this->load->model('news_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('master_mdl');
	}

	public function index()
	{
		$q = $this->input->post('q');
		if($q == '')
			redirect('user','refresh');
		$this->data['news_list'] = $this->news_mdl->global_search($q);
		$this->data['temple_list'] = $this->temple_mdl->global_search($q);
		$this->data['master_list'] = $this->master_mdl->global_search($q);
		
		$this->load->view('user/search',$this->data);
	}

}