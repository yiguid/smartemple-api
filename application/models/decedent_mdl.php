<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Decedent_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	//添加
	public function add($data)
	{
		$this->db->insert('decedent',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	//列表
	public function get()
	{
		$this->db->select('d.id,d.realname,d.sex,d.birthday,d.deathday,u.realname as providername');
		$this->db->from('decedent d');
		$this->db->join('user u','u.id=d.providerid');
		$this->db->join('offering o','o.decedentid=d.id');
		$this->db->join('space s','o.spaceid=s.id');
		if($this->session->userdata('templeid') != 0 )
			$this->db->where('s.templeid',$this->session->userdata('templeid'));
		$query = $this->db->get();
		return $query->result();
	}
	
	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('decedent');
		return TRUE;
	}

}
?>