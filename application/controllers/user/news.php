<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '新闻 - 智慧寺院';
		$this->data['nav'] = 'news';
		$this->load->model('news_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('user_mdl');
	}

	public function index()
	{
		$this->data['news_list'] = $this->news_mdl->get_list_by_page(array(), 1, 0);
		$this->session->set_userdata('news_next_page',2);
		$this->data['user_nav'] = 'news';
		//获取置顶的新闻四条
		$tmp = $this->temple_mdl->get_stick();
		$templeids = array();
		foreach ($tmp as $t) {
			$templeids[] = $t->id;
		}
		$this->data['news_stick'] = $this->news_mdl->get_index($templeids,4,0);
		$this->load->view('user/news',$this->data);
	}

	public function more()
	{
		$page = $this->session->userdata('news_next_page');
		$this->session->set_userdata('news_next_page',$this->session->userdata('news_next_page') + 1);
		$news_list = $this->news_mdl->get_list_by_page(array(), $page, 0);
		$html = '';
		foreach ($news_list as $news) {
			$html .= "<a href=\"".base_url()."user/news/id/$news->id"."\" class=\"v1-list-group-item\">";
			$html .= "<div class=\"v1-list-news-item\">";
			$html .= "<div class=\"v1-list-news-templename\">[".($news->templename!=''?$news->templename:'智慧寺院')."]</div>";
			$html .= "<div class=\"v1-list-news-title\">$news->title</div>";
			$html .= "<div class=\"v1-list-news-date\">".date('Y-m-d', strtotime($news->inputtime))."</div>";
			$html .= "</div>";
			$html .= "</a>";
		}
		echo $html;
		if($html != '' && count($news_list) == $this->news_mdl->num_per_page)
			echo "<a href=\"javascript:more('".base_url()."','news')\" class=\"btn btn-default btn-block\" id=\"more\">查看更多</a>";
		else
			echo "<a href=\"#\" class=\"btn btn-default btn-block\" id=\"more\">没有更多了</a>";
	}

	public function id($id){
		$this->data['news'] = $this->news_mdl->info($id);
		if($this->data['news'] == null)
			show_404();
		//增加阅读量
		$this->news_mdl->add_views($id,$this->data['news']->views + 1);
        $this->data['title'] = $this->data['news']->title.' - 新闻 - '.($this->data['news']->templename == ''?'智慧寺院':$this->data['news']->templename);
        $this->load->view('user/news_info',$this->data);
	}

	public function ilike(){
		extract($_REQUEST);
		$this->data['news'] = $this->news_mdl->info($id);
		//增加喜爱
		$this->news_mdl->update($id,array('like' => $this->data['news']->like + 1));
	}


	public function home()
	{
		$this->load->view('user/new_home');
	}
}