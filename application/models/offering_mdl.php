<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Offering_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	//添加
	public function add($data)
	{
		$this->db->insert('offering',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	//列表
	public function get()
	{
		$this->db->select('o.id,u.realname as providername,s.location,d.realname as decedentname');
		$this->db->from('offering o');
		$this->db->join('space s','o.spaceid=s.id');
		$this->db->join('decedent d','o.decedentid=d.id');
		$this->db->join('user u','u.id=d.providerid');
		if($this->session->userdata('templeid') != 0 )
			$this->db->where('s.templeid',$this->session->userdata('templeid'));
		$query = $this->db->get();
		return $query->result();
	}
	
	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('offering');
		return TRUE;
	}

}
?>