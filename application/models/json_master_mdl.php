<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_master_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();
	}

	public function all_get($page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id','left');	
		$this->db->join('temple','temple.id = user.templeid');
		$this->db->where('user.type','master');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);			
		$query = $this->db->get();
		return $query->result();
	}

	public function recommend_get($page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple','temple.id = user.templeid');	
		$this->db->order_by('master_detail.pos','desc');
		$this->db->where('user.type','master');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function hot_get($page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple','temple.id = user.templeid');				
		$this->db->order_by('master_detail.views','desc');	
		$this->db->where('user.type','master');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}

	public function search_get($master_name, $page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple','temple.id = user.templeid');	
		$this->db->like('user.realname',$master_name);		
		$this->db->where('user.type','master');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function timeline_get($page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id');
		$this->db->join('temple','temple.id = user.templeid');				
		$this->db->order_by('master_detail.views','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}

	public function voice_get($page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id');
		$this->db->join('temple','temple.id = user.templeid');				
		$this->db->order_by('master_detail.views','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}

	public function question_get($page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id');
		$this->db->join('temple','temple.id = user.templeid');				
		$this->db->order_by('master_detail.views','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}
}
?>