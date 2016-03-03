<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '禅修 - 智慧寺院';
		$this->data['nav'] = 'activity';
		$this->load->model('activity_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('user_mdl');
	}

	public function index()
	{
		$this->data['activity_list'] = $this->activity_mdl->get_list_by_page(array(), 1);
		$this->session->set_userdata('activity_next_page',2);
		//获取置顶的新闻四条
		$tmp = $this->temple_mdl->get_stick();
		$templeids = array();
		foreach ($tmp as $t) {
			$templeids[] = $t->id;
		}
		$this->data['activity_stick'] = $this->activity_mdl->get_index($templeids,4);
		$this->load->view('user/activity',$this->data);
	}

	public function more()
	{
		$page = $this->session->userdata('activity_next_page');
		$this->session->set_userdata('activity_next_page',$this->session->userdata('activity_next_page') + 1);
		$activity_list = $this->activity_mdl->get_list_by_page(array(), $page);
		$html = '';
		foreach ($activity_list as $activity) {
			$html .= "<a href=\"".base_url()."user/activity/id/$activity->id"."\" class=\"v1-list-group-item\">";
			$html .= "<div class=\"v1-list-news-item\">";
			$html .= "<div class=\"v1-list-news-templename\">[".($activity->templename!=''?$activity->templename:'智慧寺院')."]</div>";
			$html .= "<div class=\"v1-list-news-title\">$activity->title</div>";
			$html .= "<div class=\"v1-list-news-date\">".date('Y-m-d', strtotime($activity->inputtime))."</div>";
			$html .= "</div>";
			$html .= "</a>";
		}
		echo $html;
		if($html != '' && count($activity_list) == $this->activity_mdl->num_per_page)
			echo "<a href=\"javascript:more('".base_url()."','activity')\" class=\"btn btn-default btn-block\" id=\"more\">查看更多</a>";
		else
			echo "<a href=\"#\" class=\"btn btn-default btn-block\" id=\"more\">没有更多了</a>";
	}

	public function id($id){
		$this->data['activity'] = $this->activity_mdl->info($id);
		//增加阅读量
		$this->activity_mdl->add_views($id,$this->data['activity']->views + 1);
		if($this->data['activity'] == null)
			show_404();
        $this->data['title'] = $this->data['activity']->title.' - 禅修 - '.($this->data['activity']->templename == ''?'智慧寺院':$this->data['activity']->templename);
        $this->data['register_list'] = $this->activity_mdl->get_register($id);
        $this->data['is_register'] = $this->activity_mdl->is_register($this->session->userdata('id'),$id);
        $this->session->set_userdata('jump_from','user/activity/id/'.$id);
        $this->load->view('user/activity_info',$this->data);
	}

	public function register($templeid,$activityid)
	{
		if(!$this->auth->logged_in())
		{
			redirect('login','refresh');
		}
		//检查用户信息是否齐全
		$is_detail = $this->user_mdl->check_user_detail($this->session->userdata('id'));

		if($is_detail){
			$registertime = date("Y-m-d H:i:s");
			$data = array(
				'id' => "A".date("YmdHis").substr(md5($registertime),0,6),
				'activityid' => $activityid,
				'userid' => $this->session->userdata('id'),
				'registertime' => $registertime,
				'applicant' => $this->input->post('applicant'),
				'contact' => $this->input->post('contact'),
				'email' => '',
				'status' => '已报名',
				'remark' => $this->input->post('remark')
			);
			$this->activity_mdl->register($data);
			redirect('user/activity/id/'.$activityid);
		}
		else{
			//提示信息需补全
			$this->data['home_nav'] = 'setting';
			$this->data['user'] = $this->user_mdl->info($this->session->userdata('id'));
			$this->data['notice'] = '个人信息不全，请填写完毕后再报名';
			$this->load->view('user/home/setting',$this->data);
		}

	}

	public function ilike(){
		extract($_REQUEST);
		$this->data['activity'] = $this->activity_mdl->info($id);
		//增加喜爱
		$this->activity_mdl->update($id,array('like' => $this->data['activity']->like + 1));
	}

	public function quit($activityid)
	{
		if(!$this->auth->logged_in())
		{
			redirect('login','refresh');
		}
		$this->activity_mdl->quit($this->session->userdata('id'),$activityid);
		redirect('user/activity/id/'.$activityid);
	}
}