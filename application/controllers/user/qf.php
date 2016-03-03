<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qf extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '留言 - 智慧寺院';
		$this->data['nav'] = 'qf';
		$this->load->model('wishboard_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('user_mdl');
	}

	public function index()
	{
		$this->data['qf_list'] = $this->wishboard_mdl->get_list_by_page(array(), 1);
		$this->session->set_userdata('qf_next_page',2);
		//获取置顶的新闻四条
		$tmp = $this->temple_mdl->get_stick();
		$templeids = array();
		foreach ($tmp as $t) {
			$templeids[] = $t->id;
		}
		$this->data['qf_stick'] = $this->wishboard_mdl->get_index($templeids,4);
		$this->load->view('user/qf',$this->data);
	}

	public function more()
	{
		$page = $this->session->userdata('qf_next_page');
		$this->session->set_userdata('qf_next_page',$this->session->userdata('qf_next_page') + 1);
		$qf_list = $this->wishboard_mdl->get_list_by_page(array(), $page);
		$html = '';
		foreach ($qf_list as $qf) {
			$html .= "<a href=\"".base_url()."qf/temple/$qf->templeid"."\" class=\"v1-list-group-item\">";
			$html .= "<div class=\"v1-list-news-item\">";
			$html .= "<div class=\"v1-list-news-templename\">[".($qf->templename!=''?$qf->templename:'智慧寺院')."]</div>";
			$html .= "<div class=\"v1-list-news-title\">$qf->content</div>";
			$html .= "<div class=\"v1-list-news-date\">".date('Y-m-d', strtotime($qf->datetime))."</div>";
			$html .= "</div>";
			$html .= "</a>";
		}
		echo $html;
		if($html != '' && count($qf_list) == $this->wishboard_mdl->num_per_page)
			echo "<a href=\"javascript:more('".base_url()."','qf')\" class=\"btn btn-default btn-block\" id=\"more\">查看更多</a>";
		else
			echo "<a href=\"#\" class=\"btn btn-default btn-block\" id=\"more\">没有更多了</a>";
	}
}