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
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'admin')
		{
			redirect('login','refresh');
		}
		$this->data['nav'] = 'volunteer';
		$this->data['nav_info'] = '管理后台';
		$this->data['sidebar'] = 'volunteer';
		$this->data['title'] = '义工管理 - 智慧寺院';
		$this->load->model('temple_mdl');
		$this->load->model('volunteer_mdl');
		$this->load->model('question_mdl');
		$temple_list = $this->temple_mdl->get();
		$this->data['templeids'] = array();
		$this->data['templeids'][0] = '智慧寺院';
		foreach ($temple_list as $temple) {
			$this->data['templeids'][$temple->id] = $temple->name; 
		}
	}

	//templeid = 0 的都是admin添加的新闻
	//templeid = -1 获取全部新闻

	public function index()
	{	
		$this->session->unset_userdata('q');
		$this->data['volunteer_list'] = $this->volunteer_mdl->get(1,-1);
		$this->data['cur_page'] = 1;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->volunteer_mdl->get_page(-1);
		$this->load->view('admin/volunteer/index', $this->data);
	}

	public function page($page)
	{
		if($page < 1)
			$page = 1;
		$this->data['volunteer_list'] = $this->volunteer_mdl->get($page,-1); 
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->volunteer_mdl->get_page(-1);
		$this->load->view('admin/volunteer/index',$this->data);
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
		$this->data['volunteer_list'] = $this->volunteer_mdl->search($q,$page,-1);
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'search';
		$this->data['total_page'] = $this->volunteer_mdl->search_page($q,-1);
		$this->load->view('admin/volunteer/index',$this->data);
	}

	public function add()
	{
		$this->form_validation->set_rules('title','标题','required|trim');
		$this->form_validation->set_rules('cost','花费','required|trim');
		$this->form_validation->set_rules('capacity','人数','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/volunteer/edit',$this->data);
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
				'hostid' => $this->input->post('templeid')
			);
			$this->volunteer_mdl->add($volunteer);
			redirect('admin/volunteer');
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('title','标题','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->data['volunteer'] = $this->volunteer_mdl->info($id);
			$this->load->view('admin/volunteer/edit',$this->data);
		}else{
			//编辑
			$volunteer = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'capacity' => $this->input->post('capacity'),
					'description' => substr($this->input->post('description'), 0, 90),
					'starttime' => $this->input->post('starttime'),
					'endtime' => $this->input->post('endtime'),
					'location' => $this->input->post('location'),
					'hostid' => $this->input->post('templeid')
				);
			$this->volunteer_mdl->update($id,$volunteer);
			redirect('admin/volunteer');
		}
	}

	public function delete($id)
	{
		$this->volunteer_mdl->delete($id);
		redirect('admin/volunteer');
	}

	public function id($id)
	{
		$this->data['volunteer'] = $this->volunteer_mdl->info($id);
		$this->data['register_list'] = $this->volunteer_mdl->get_register($id);
		$this->load->view('admin/volunteer/info',$this->data);
	}

	//问卷相关
	//get questions

	public function question()
	{
		$this->data['question_list'] = $this->question_mdl->get();
		$this->load->view('admin/volunteer/question/index', $this->data);
	}

	public function question_preview()
	{
		$this->data['question_list'] = $this->question_mdl->get();
		$this->data['option_list'] = $this->question_mdl->get_option();
		$this->load->view('admin/volunteer/question/preview', $this->data);
	}

	public function question_add()
	{
		$this->form_validation->set_rules('type','类别','required|trim');
		$this->form_validation->set_rules('info','标题','required|trim');
		$this->form_validation->set_rules('description','描述','trim');

		if($this->form_validation->run() == FALSE){
			$this->data['question_types'] = array('0' => '单选','1' => '多选','2' => '问答');
			$this->load->view('admin/volunteer/question/edit',$this->data);
		}else{
			$question = array(
				'type' => $this->input->post('type'),
				'info' => $this->input->post('info'),
				'description' => $this->input->post('description')
			);
			$this->question_mdl->add($question);
			redirect('admin/volunteer/question');
		}
	}

	public function question_option_add($id)
	{
		$this->form_validation->set_rules('info','标题','required|trim');
		$this->form_validation->set_rules('description','描述','trim');

		if($this->form_validation->run() == FALSE){
			$this->data['question'] = $this->question_mdl->info($id);
			$this->data['option_list'] = $this->question_mdl->get_option($id);
			$this->load->view('admin/volunteer/question/info',$this->data);
		}else{
			$option = array(
				'questionid' => $id,
				'need_detail' => $this->input->post('need_detail'),
				'info' => $this->input->post('info'),
				'description' => $this->input->post('description')
			);
			$this->question_mdl->add_option($option);
			redirect('admin/volunteer/question_id/'.$id);
		}
	}

	public function question_edit($id)
	{
		$this->form_validation->set_rules('type','类别','required|trim');
		$this->form_validation->set_rules('info','标题','required|trim');
		$this->form_validation->set_rules('description','描述','trim');

		if($this->form_validation->run() == FALSE){
			$this->data['question_types'] = array('0' => '单选','1' => '多选','2' => '问答');
			$this->data['question'] = $this->question_mdl->info($id);
			$this->load->view('admin/volunteer/question/edit',$this->data);
		}else{
			$question = array(
				'type' => $this->input->post('type'),
				'info' => $this->input->post('info'),
				'description' => $this->input->post('description')
			);
			$this->question_mdl->update($id,$question);
			redirect('admin/volunteer/question');
		}
	}
	
	public function question_delete($id)
	{
		$this->question_mdl->delete($id);
		redirect('admin/volunteer/question');
	}

	public function question_option_delete($questionid,$optionid)
	{
		$this->question_mdl->delete_option($optionid);
		redirect('admin/volunteer/question_id/'.$questionid);
	}

	public function question_id($id)
	{
		$this->data['question'] = $this->question_mdl->info($id);
		$this->data['option_list'] = $this->question_mdl->get_option($id);
		$this->load->view('admin/volunteer/question/info',$this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */