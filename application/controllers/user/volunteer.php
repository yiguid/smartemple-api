<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Volunteer extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '义工 - 智慧寺院';
		$this->data['nav'] = 'volunteer';
		$this->load->model('temple_mdl');
		$this->load->model('volunteer_mdl');
		$this->load->model('question_mdl');
		$this->load->model('user_mdl');
	}

	public function index()
	{
		$this->data['volunteer_list'] = $this->volunteer_mdl->get_list_by_page(array(), 1);
		$this->session->set_userdata('volunteer_next_page',2);
		//获取置顶的新闻四条
		$tmp = $this->temple_mdl->get_stick();
		$templeids = array();
		foreach ($tmp as $t) {
			$templeids[] = $t->id;
		}
		$this->data['volunteer_stick'] = $this->volunteer_mdl->get_index($templeids,4);
		$this->load->view('user/volunteer',$this->data);
	}

	public function more()
	{
		$page = $this->session->userdata('volunteer_next_page');
		$this->session->set_userdata('volunteer_next_page',$this->session->userdata('volunteer_next_page') + 1);
		$volunteer_list = $this->volunteer_mdl->get_list_by_page(array(), $page);
		$html = '';
		foreach ($volunteer_list as $volunteer) {
			$html .= "<a href=\"".base_url()."user/volunteer/id/$volunteer->id"."\" class=\"v1-list-group-item\">";
			$html .= "<div class=\"v1-list-news-item\">";
			$html .= "<div class=\"v1-list-news-templename\">[".($volunteer->templename!=''?$volunteer->templename:'智慧寺院')."]</div>";
			$html .= "<div class=\"v1-list-news-title\">$volunteer->title</div>";
			$html .= "<div class=\"v1-list-news-date\">".date('Y-m-d', strtotime($volunteer->inputtime))."</div>";
			$html .= "</div>";
			$html .= "</a>";
		}
		echo $html;
		if($html != '' && count($volunteer_list) == $this->volunteer_mdl->num_per_page)
			echo "<a href=\"javascript:more('".base_url()."','volunteer')\" class=\"btn btn-default btn-block\" id=\"more\">查看更多</a>";
		else
			echo "<a href=\"#\" class=\"btn btn-default btn-block\" id=\"more\">没有更多了</a>";
	}

	public function id($id){
		$this->data['volunteer'] = $this->volunteer_mdl->info($id);
		//增加阅读量
		$this->volunteer_mdl->add_views($id,$this->data['volunteer']->views + 1);
		if($this->data['volunteer'] == null)
			show_404();
        $this->data['title'] = $this->data['volunteer']->title.' - 义工 - '.($this->data['volunteer']->templename == ''?'智慧寺院':$this->data['volunteer']->templename);
        $this->data['register_list'] = $this->volunteer_mdl->get_register($id);
        $this->data['is_register'] = $this->volunteer_mdl->is_register($this->session->userdata('id'),$id);
        $this->session->set_userdata('jump_from','user/volunteer/id/'.$id);
        $this->data['question_list'] = $this->question_mdl->get();
		$this->data['option_list'] = $this->question_mdl->get_option();
        $this->load->view('user/volunteer_info',$this->data);
	}

	public function register($templeid,$volunteerid)
	{
		if(!$this->auth->logged_in())
		{
			redirect('login','refresh');
		}
		//检查用户信息是否齐全
		$is_detail = $this->user_mdl->check_user_detail($this->session->userdata('id'));
		$registertime = date("Y-m-d H:i:s");
		$registerid = "V".date("YmdHis").substr(md5($registertime),0,6);
		if($is_detail){
			$user = $this->user_mdl->info($this->session->userdata('id'));
			$data = array(
				'id' => $registerid,
				'volunteerid' => $volunteerid,
				'userid' => $this->session->userdata('id'),
				'registertime' => $registertime,
				'applicant' => $user->realname,
				'contact' => $user->mobile,
				'email' => '',
				'status' => '已报名',
				'remark' => $this->input->post('remark')
			);
			//存储报名信息
			$this->volunteer_mdl->register($data);
			//获得问卷答案
			$question_list = $this->question_mdl->get();
			$option_list = $this->question_mdl->get_option();
			$option_arr = array();
			foreach ($option_list as $option) {
				$option_arr[$option->id] = $option;
			}

			foreach ($question_list as $question) {
				switch ($question->type) {
					//单选
					case 0:
						$optionid = $this->input->post('radio'.$question->id);
						$option_detail = '';
						if($option_arr[$optionid]->need_detail)
							$option_detail = $this->input->post('input'.$question->id);
						$this->volunteer_mdl->add_register_answer($registerid,$question->id,$optionid,$option_detail);
						break;
					//多选
					case 1:
						$check_arr = $this->input->post('checkbox'.$question->id);
						//var_dump($check_arr);
						foreach ($check_arr as $optionid) {
							$option_detail = '';
							if($option_arr[$optionid]->need_detail)
								$option_detail = $this->input->post('input'.$question->id);
							$this->volunteer_mdl->add_register_answer($registerid,$question->id,$optionid,$option_detail);
						}
						break;
					default:
						# code...
						break;
				}
			}

			redirect('user/volunteer/id/'.$volunteerid);
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
		$this->data['volunteer'] = $this->volunteer_mdl->info($id);
		//增加喜爱
		$this->volunteer_mdl->update($id,array('like' => $this->data['volunteer']->like + 1));
	}

	public function quit($volunteerid)
	{
		if(!$this->auth->logged_in())
		{
			redirect('login','refresh');
		}
		$this->volunteer_mdl->quit($this->session->userdata('id'),$volunteerid);
		redirect('user/volunteer/id/'.$volunteerid);
	}

}