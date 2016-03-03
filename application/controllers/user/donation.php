<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donation extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '捐助 - 智慧寺院';
		$this->data['nav'] = 'donation';
		$this->load->model('donation_mdl');
		$this->load->model('zhongchou_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('user_mdl');
	}

	public function index()
	{
		//$this->data['donation_list'] = $this->donation_mdl->get_index(array(), 10);
		$this->data['temple_list'] = $this->temple_mdl->get_index(array(), 12);
		$this->data['roll_list'] = $this->donation_mdl->get_recent_roll(array(),1,TRUE);
		$this->data['zhongchou_list'] = $this->zhongchou_mdl->get_index(array(), 3);
		$this->load->view('user/donation',$this->data);
	}

	public function roll()
	{
		$this->data['roll_list'] = $this->donation_mdl->get_recent_roll(array(),1,TRUE);
		$this->session->set_userdata('roll_next_page',2);
		$this->load->view('user/donation_roll',$this->data);
	}

	//this function is for roll list more
	public function more()
	{
		$page = $this->session->userdata('roll_next_page');
		$this->session->set_userdata('roll_next_page',$this->session->userdata('roll_next_page') + 1);
		$roll_list = $this->donation_mdl->get_recent_roll(array(), $page, TRUE);
		$html = '';
		foreach ($roll_list as $roll) {
			$html .= "<a href=\"".base_url()."temple/id/$roll->templeid"."\" class=\"v1-list-group-item\">";
			$html .= "<div class=\"v1-list-news-item\">";
			$html .= "<div class=\"v1-list-news-templename\">[".($roll->templename!=''?$roll->templename:'智慧寺院')."]</div>";
			$html .= "<div class=\"v1-list-news-title\">".$roll->contact.'捐助'.$roll->total.'元</div>';
			$html .= "<div class=\"v1-list-news-date\">".date('Y-m-d', strtotime($roll->ordertime))."</div>";
			$html .= "</div>";
			$html .= "</a>";
		}
		echo $html;
		if($html != '' && count($roll_list) == $this->donation_mdl->num_per_page)
			echo "<a href=\"javascript:more('".base_url()."','donation')\" class=\"btn btn-default btn-block\" id=\"more\">查看更多</a>";
		else
			echo "<a href=\"#\" class=\"btn btn-default btn-block\" id=\"more\">没有更多了</a>";
	}
}