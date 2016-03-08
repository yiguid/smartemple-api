<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '大德说 - 智慧寺院网';
		$this->load->model('dadeshuo_mdl');
	}

	public function index()
	{
		$this->load->view('dadeshuo/index',$this->data);
	}

	public function info($id)
	{			
		$this->data['info'] = $this->dadeshuo_mdl->info($id);
		$this->data['answer'] = $this->dadeshuo_mdl->get_answer($id);
		$this->load->view('dadeshuo/info',$this->data);
	}

	public function add($id)
	{			
		$this->load->view('dadeshuo/info',$this->data);
	}

	public function qlist($page = 1,$num_per_page = 10)
	{
		$this->data['list'] = $this->dadeshuo_mdl->qlist($page,$num_per_page);
		$this->load->view('dadeshuo/list',$this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */