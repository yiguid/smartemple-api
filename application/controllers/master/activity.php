<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller {

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
		$this->data['nav'] = 'activity';
		$this->data['temple'] = $this->temple_mdl->info($this->session->userdata('templeid'));
		$this->data['nav_info'] = $this->data['temple']->name;
		$this->data['sidebar'] = 'activity';
		$this->data['title'] = '义工禅修 - 智慧寺院';
		$this->load->model('activity_mdl');
		//暂时隐掉禅修活动类别
		// $options = $this->activity_mdl->get_cat($this->session->userdata('templeid'));
		// $this->data['category_options'] = array();
		// foreach ($options as $op) {
		// 	$this->data['category_options'][$op->id] = $op->name; 
		// }
	}

	public function index()
	{	
		$this->session->unset_userdata('q');
		$this->data['activity_list'] = $this->activity_mdl->get(1,$this->session->userdata('templeid'));
		$this->data['cur_page'] = 1;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->activity_mdl->get_page($this->session->userdata('templeid'));
		$this->load->view('master/activity/index', $this->data);
	}

	public function page($page)
	{
		if($page < 1)
			$page = 1;
		$this->data['activity_list'] = $this->activity_mdl->get($page,$this->session->userdata('templeid')); 
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->activity_mdl->get_page($this->session->userdata('templeid'));
		$this->load->view('master/activity/index',$this->data);
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
		$this->data['activity_list'] = $this->activity_mdl->search($q,$page,$this->session->userdata('templeid'));
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'search';
		$this->data['total_page'] = $this->activity_mdl->search_page($q,$this->session->userdata('templeid'));
		$this->load->view('master/activity/index',$this->data);
	}

	public function add()
	{
		$this->data['sidebar'] = 'add';
		$this->form_validation->set_rules('title','标题','required|trim');
		//$this->form_validation->set_rules('catid','内容','required|trim');
		$this->form_validation->set_rules('cost','花费','required|trim');
		$this->form_validation->set_rules('capacity','人数','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('master/activity/edit',$this->data);
		}else{
			$activity = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'description' => substr($this->input->post('description'), 0, 90),
				'catid' => 0,
				'cost' => $this->input->post('cost'),
				'capacity' => $this->input->post('capacity'),
				'starttime' => $this->input->post('starttime'),
				'endtime' => $this->input->post('endtime'),
				'inputtime' => date("Y-m-d H:i:s"),
				'location' => $this->input->post('location'),
				'hostid' => $this->session->userdata('templeid')
			);
			$this->activity_mdl->add($activity);
			redirect('master/activity');
		}
	}

	public function ajax_add_category()
	{
		extract($_REQUEST);
		$id = $this->activity_mdl->add_cat(
				array('name' => $name,'pos' => 0,'hostid' => $this->session->userdata('templeid'))
			);
		if($id){
			echo "<tr id=\"catoptr$id\" >";
		 	echo "<td>$id</td><td><input id=\"catop$id\" value=\"".$name."\"></input></td>";
		 	echo "<td><a href=\"javascript:edit_activity_category('".base_url()."',".$id.")\"><span class=\"glyphicon glyphicon-pencil\"></span></a> <a href=\"javascript:delete_activity_category('".base_url()."',".$id.")\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>";
		 	echo "</tr>";
		}
		else
			echo false;
	}

	public function ajax_delete_category()
	{
		extract($_REQUEST);
		if($this->activity_mdl->delete_cat($id)){
			echo true;
		}
		else
			echo false;
	}

	public function ajax_edit_category()
	{
		extract($_REQUEST);
		if($this->activity_mdl->update_cat($id,array('name'=>$name))){
			echo true;
		}
		else
			echo false;
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('title','标题','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->data['activity'] = $this->activity_mdl->info($id);
			$this->load->view('master/activity/edit',$this->data);
		}else{
			//编辑
			$activity = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'description' => substr($this->input->post('description'), 0, 90),
					'starttime' => $this->input->post('starttime'),
					'location' => $this->input->post('location'),
					'endtime' => $this->input->post('endtime')
				);
			$this->activity_mdl->update($id,$activity);
			redirect('master/activity');
		}
	}

	public function edit_cat($templeid){
		$this->data['activity_cat'] = $this->activity_mdl->get_cat($templeid);
		$this->load->view('master/activity/edit_cat',$this->data);
	}

	public function delete($id)
	{
		$this->activity_mdl->delete($id);
		redirect('master/activity');
	}

	public function id($id)
	{
		$this->data['activity'] = $this->activity_mdl->info($id);
		$this->data['register_list'] = $this->activity_mdl->get_register($id);
		$this->load->view('master/activity/info',$this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */