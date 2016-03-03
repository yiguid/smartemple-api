<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Question_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	//添加
	public function add($data)
	{
		$this->db->insert('volunteer_form_question',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function add_option($data)
	{
		$this->db->insert('volunteer_form_question_option',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	//列表
	public function get()
	{
		$this->db->select('*');
		$this->db->from('volunteer_form_question');
		$query = $this->db->get();
		return $query->result();
	}

	public function info($id)
	{
		$this->db->select('*');
        $this->db->from('volunteer_form_question');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	public function get_option($id = 0)
	{
		$this->db->select('*');
		$this->db->from('volunteer_form_question_option');
		if($id != 0)
			$this->db->where('questionid',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('volunteer_form_question');
		return TRUE;
	}

	public function delete_option($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('volunteer_form_question_option');
		return TRUE;
	}

	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('volunteer_form_question',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}
?>