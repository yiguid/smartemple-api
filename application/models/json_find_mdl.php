<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_find_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();
	}

	public function temple_get($page, $num_per_page)
	{
		$this->db->select('temple.id as templeid,user.id as masterid,temple.name,temple.province,temple.city,temple.master,temple.homeimg,master_detail.avatar,temple_qf_count.qfcount as views');
		$this->db->from('temple');		
		$this->db->join('user','user.templeid = temple.id');
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple_qf_count','temple_qf_count.templeid = temple.id','left');
		$this->db->where('temple.closed',0);
		$this->db->where('temple.verified',1);
		$this->db->where('user.type','master');	
		$this->db->order_by('temple.pos','desc');	
		$this->db->group_by('temple.id');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function master_get($page, $num_per_page)
	{
		$this->db->select('temple.id as templeid,user.id as masterid,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple','temple.id = user.templeid');		
		$this->db->where('user.type','master');	
		$this->db->order_by('master_detail.pos','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function news_get($page, $num_per_page)
	{
		$this->db->select('news.id,news.like,news.title,news.description,news.updatetime,news.views,user.realname');
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
		$this->db->select('id,title,description,starttime,endtime,location,views,like');
		$this->db->from('activity');
		$this->db->where('endtime >',$time);	
		$this->db->order_by('inputtime','desc');			
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}
}
?>