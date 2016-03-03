<?php 
error_reporting(E_ALL || ~E_NOTICE);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

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
		$this->data['title'] = '智慧寺院 - 消息管理';
		$this->data['nav'] = 'manage';
		$this->data['nav_info'] = '管理后台';
		$this->data['sidebar'] = 'message';
	}

	public function index()
	{	
		$id = $this->session->userdata('id');		
		$this->data['message'] = $this->message_mdl->get_message($id);
		$this->load->view('admin/message', $this->data);				
	}

	public function type($type)
	{		
		$id = $this->session->userdata('id');
		$this->data['message'] = $this->message_mdl->get_message($id,$type);
		$this->data['type'] = $type;
		$this->load->view('admin/message', $this->data);
	}

	public function issue($type,$username)
	{				
		$this->data['type'] = $type;
		$this->data['username'] = $username;
		$this->load->view('admin/issue',$this->data);	
	}

	public function ajax_issue()
	{
		echo $this->message_mdl->ajax_issue();
	}

	public function data_issue()
	{
		$username = $this->input->post('username');
		$content = $this->input->post('editorValue');		
		$this->data['msg'] = $this->message_mdl->data_issue($username,strip_tags($content));
		$id = $this->session->userdata('id');		
		$this->data['message'] = $this->message_mdl->get_message($id);
		$this->load->view('admin/message', $this->data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */