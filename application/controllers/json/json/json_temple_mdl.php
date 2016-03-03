<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_temple_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();
	}

	public function all_get($page, $num_per_page)
	{
		$this->db->select('name,province,city,master');
		$this->db->from('temple');		
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$this->db->where('closed',0);
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
		$this->db->select('name,province,city,master');
		$this->db->from('temple');	
		$this->db->order_by('pos','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$this->db->where('closed',0);
		$query = $this->db->get();
		return $query->result();
	}

	public function hot_get($page, $num_per_page)
	{
		$this->db->select('temple.name,temple.province,temple.city,temple.master');
		$this->db->from('temple');
		$this->db->join('donation_order','donation_order.templeid = temple.id');	
		$this->db->group_by("templeid"); 		 
		$this->db->order_by('count(1)','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$this->db->where('closed',0);
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