<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Space_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	//添加
	public function add($data)
	{
		$this->db->insert('space',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	//列表
	public function get($templeid = 0)
	{
		$this->db->select('*');
		$this->db->from('space');
		if($templeid != 0 )
			$this->db->where('templeid',$templeid);
		$query = $this->db->get();
		return $query->result();
	}

	public function info($id)
	{
		$this->db->select('*');
        $this->db->from('space');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}
	
	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('space');
		return TRUE;
	}

	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('space',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}
?>