<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dadeshuo_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();

	}

	//添加
	public function add($data)
	{
		$this->db->insert('dadeshuo_question',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function qlist($page, $num_per_page)
	{
		$this->db->select('q.*,count(a.questionid) as answer');
		$this->db->from('dadeshuo_question q');
		$this->db->join('dadeshuo_answer a','a.questionid=q.id','left');
		$this->db->group_by('q.id');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('dadeshuo_question');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function info($id)
	{
		$this->db->select('q.*,u.realname');
		$this->db->from('dadeshuo_question q');
		$this->db->join('user u','u.id=q.userid');
		$this->db->where('q.id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_answer($id)
	{
		$this->db->select('a.*,u.realname,m.avatar');
		$this->db->from('dadeshuo_answer a');
		$this->db->join('user u','u.id=a.userid');
		$this->db->join('master_detail m','m.masterid=a.userid');
		$this->db->where('a.id',$id);				
		$query = $this->db->get();
		return $query->result();
	}

	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('dadeshuo_question');
		return TRUE;
	}

	//修改
	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('dadeshuo_question',$data);
		return TRUE;
	}

}
?>