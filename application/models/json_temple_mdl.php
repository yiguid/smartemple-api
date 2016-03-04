<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_temple_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();
	}

	public function all_get($page, $num_per_page)
	{
		$this->db->select('temple.name,temple.province,temple.city,temple.master,temple.homeimg,master_detail.avatar');
		$this->db->from('temple');		
		$this->db->join('user','user.templeid = temple.id');
		$this->db->join('master_detail','master_detail.masterid = user.id');
		$this->db->where('temple.closed',0);
		$this->db->where('temple.verified',1);
		$this->db->where('user.type','master');		
		$this->db->group_by('temple.id');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function attention_get($templeid_arr, $id, $page, $num_per_page)
	{
		$this->db->select('name,province,city,master');
		$this->db->from('temple');	
		//$this->db->join('user','user.id = temple.id');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$this->db->where('closed',0);
		$query = $this->db->get();
		return $query->result();
	}

	public function recommend_get($page, $num_per_page)
	{
		$this->db->select('temple.name,temple.province,temple.city,temple.master,temple.homeimg,master_detail.avatar');
		$this->db->from('temple');		
		$this->db->join('user','user.templeid = temple.id');
		$this->db->join('master_detail','master_detail.masterid = user.id');
		$this->db->where('temple.closed',0);
		$this->db->where('temple.verified',1);
		$this->db->where('user.type','master');	
		$this->db->order_by('temple.pos','desc');	
		$this->db->group_by('temple.id');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function hot_get($page, $num_per_page)
	{
		$this->db->select('temple.name,temple.province,temple.city,temple.master,temple.homeimg,master_detail.avatar');
		$this->db->from('temple');		
		$this->db->join('user','user.templeid = temple.id');
		$this->db->join('master_detail','master_detail.masterid = user.id');
		$this->db->join('temple_qf_count','temple_qf_count.templeid = temple.id');
		$this->db->where('temple.closed',0);
		$this->db->where('temple.verified',1);
		$this->db->where('user.type','master');	
		$this->db->order_by('temple_qf_count.qfcount','desc');	
		$this->db->group_by('temple.id');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function search_get($temple_name, $page, $num_per_page)
	{
		$this->db->select('temple.name,temple.province,temple.city,temple.master');
		$this->db->from('temple');
		$this->db->like('name',$temple_name);		
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$this->db->where('closed',0);
		$query = $this->db->get();
		return $query->result();
	}
}
?>