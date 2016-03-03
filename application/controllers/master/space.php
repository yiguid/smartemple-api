<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Space extends CI_Controller {

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
		$this->load->model('space_mdl');
		$this->load->model('temple_mdl');
		$this->data['title'] = '智慧寺院 - 福位管理';
		$this->data['nav'] = 'digong';
		$this->data['temple'] = $this->temple_mdl->info($this->session->userdata('templeid'));
		$this->data['nav_info'] = $this->data['temple']->name;
		$this->data['sidebar'] = 'space';
	}

	public function index()
	{	
		$templeid = $this->session->userdata('templeid');
		$this->data['space'] = $this->space_mdl->get($templeid);
		$this->load->view('master/space', $this->data);
	}

	public function add()
	{
		$this->form_validation->set_rules('location','位置','required|trim');
		$this->form_validation->set_rules('class','级别','required|trim');
		$this->form_validation->set_rules('price','价格','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('master/space_add',$this->data);
		}else{
			$templeid = $this->session->userdata('templeid');
			$location = $this->input->post('location');
			$class = $this->input->post('class');
			$price = $this->input->post('price');
			$this->space_mdl->add(array('templeid' => $templeid, 'location' => $location,'class' => $class,'price' => $price));
			redirect('master/space','refresh');
		}
	}	

	public function id($id)
	{
		$this->data['entry'] = $this->space_mdl->info($id);
		$this->load->view('master/space_info',$this->data);
	}

	public function edit($id)
	{	
		$this->data['entry'] = $this->space_mdl->info($id);
		$this->form_validation->set_rules('location','位置','required|trim');
		$this->form_validation->set_rules('class','级别','required|trim');
		$this->form_validation->set_rules('price','价格','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('master/space_edit',$this->data);
		}else{
			$location = $this->input->post('location');
			$class = $this->input->post('class');
			$price = $this->input->post('price');
			$this->space_mdl->update($id, array('location' => $location,'class' => $class,'price' => $price));
			redirect('master/space','refresh');
		}
	}

	public function delete($id)
	{
		$this->space_mdl->delete($id);
		redirect('master/space','refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */