<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_find_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();
	}

	public function temple_get($page, $num_per_page)
	{
		$this->db->select('name,province,city,master');
		$this->db->from('temple');	
		$this->db->order_by('pos','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$this->db->where('closed',0);
		$query = $this->db->get();
		return $query->result();
	}

	public function master_get($page, $num_per_page)
	{
		$this->db->select('user.realname,master_detail.avatar');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id');	
		$this->db->order_by('pos','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function news_get($page, $num_per_page)
	{
		$this->db->select('news.title,news.description,news.updatetime,news.views,user.realname');
		$this->db->from('news');	
		$this->db->join('user','user.username = news.username');	
		$this->db->order_by('updatetime','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function activity_get($page, $num_per_page)
	{
		$time = date('Y-m-d H:i:s',strtotime('now'));
		$this->db->select('title,description,starttime,endtime,location,views');
		$this->db->from('activity');
		$this->db->order_by('inputtime','desc');
		$this->db->where('endtime >',$time);				
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}
}
?>