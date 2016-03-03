<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Volunteer extends CI_Controller {

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
		$this->data['sidebar'] = 'volunteer';
		$this->data['title'] = '义工管理 - 智慧寺院';
		$this->load->model('temple_mdl');
		$this->load->model('volunteer_mdl');
		$this->load->model('question_mdl');
		$this->data['nav'] = 'volunteer';
		$this->data['temple'] = $this->temple_mdl->info($this->session->userdata('templeid'));
		$this->data['nav_info'] = $this->data['temple']->name;
	}

	public function index()
	{	
		$this->session->unset_userdata('q');
		$this->data['volunteer_list'] = $this->volunteer_mdl->get(1,$this->session->userdata('templeid'));
		$this->data['cur_page'] = 1;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->volunteer_mdl->get_page($this->session->userdata('templeid'));
		$this->load->view('master/volunteer/index', $this->data);
	}

	public function page($page)
	{
		if($page < 1)
			$page = 1;
		$this->data['volunteer_list'] = $this->volunteer_mdl->get($page,$this->session->userdata('templeid')); 
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->volunteer_mdl->get_page($this->session->userdata('templeid'));
		$this->load->view('master/volunteer/index',$this->data);
	}

	public function search($page = 1)
	{
		if($page < 1)
			$page = 1;
		$q = $this->input->post('q');
		if($q != "")
			$this->session->set_userdata('q', $q);
		else
			$q = $this->session->userdata('q');
		$this->data['volunteer_list'] = $this->volunteer_mdl->search($q,$page,$this->session->userdata('templeid'));
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'search';
		$this->data['total_page'] = $this->volunteer_mdl->search_page($q,$this->session->userdata('templeid'));
		$this->load->view('master/volunteer/index',$this->data);
	}

	public function add()
	{
		$this->data['sidebar'] = 'add';
		$this->form_validation->set_rules('title','标题','required|trim');
		$this->form_validation->set_rules('cost','花费','required|trim');
		$this->form_validation->set_rules('capacity','人数','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('master/volunteer/edit',$this->data);
		}else{
			$volunteer = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'description' => substr($this->input->post('description'), 0, 90),
				'catid' => 0,
				'cost' => $this->input->post('cost'),
				'capacity' => $this->input->post('capacity'),
				'starttime' => $this->input->post('starttime'),
				'endtime' => $this->input->post('endtime'),
				'location' => $this->input->post('location'),
				'inputtime' => date("Y-m-d H:i:s"),
				'hostid' => $this->session->userdata('templeid')
			);
			$this->volunteer_mdl->add($volunteer);
			redirect('master/volunteer');
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('title','标题','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->data['volunteer'] = $this->volunteer_mdl->info($id);
			$this->load->view('master/volunteer/edit',$this->data);
		}else{
			//编辑
			$volunteer = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'description' => substr($this->input->post('description'), 0, 90),
					'starttime' => $this->input->post('starttime'),
					'endtime' => $this->input->post('endtime'),
					'location' => $this->input->post('location'),
					'hostid' => $this->session->userdata('templeid')
				);
			$this->volunteer_mdl->update($id,$volunteer);
			redirect('master/volunteer');
		}
	}

	public function delete($id)
	{
		$this->volunteer_mdl->delete($id);
		redirect('master/volunteer');
	}

	public function show_answer($volunteerid,$userid)
	{
		//获取义工信息，注册信息，问卷填写信息，问卷原始信息和问卷选项
		$this->data['volunteer'] = $this->volunteer_mdl->info($volunteerid);
		$this->data['register'] = $this->volunteer_mdl->get_register_by_user($volunteerid,$userid);
		$this->data['answer_list'] = $this->volunteer_mdl->get_register_answer($this->data['register']->id);
		$this->data['question_list'] = $this->question_mdl->get();
		$this->data['option_list'] = $this->question_mdl->get_option();
		$this->load->view('master/volunteer/volunteer_answer',$this->data);
	}

	public function id($id)
	{
		$this->data['volunteer'] = $this->volunteer_mdl->info($id);
		$this->data['register_list'] = $this->volunteer_mdl->get_register($id);
		$this->load->view('master/volunteer/info',$this->data);
	}

	//问卷相关
	//get questions
	public function question_preview()
	{
		$this->data['question_list'] = $this->question_mdl->get();
		$this->data['option_list'] = $this->question_mdl->get_option();
		$this->load->view('master/volunteer/question_preview', $this->data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */