<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Volunteer_mdl extends CI_Model {
	public $num_per_page = 15;
	public function __construct()
	{
		parent:: __construct();

	}

	//添加
	public function add($data)
	{
		$this->db->insert('volunteer',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	//获取
	//templeid = 0 的都是admin添加的
	//templeid = -1 获取全部的
	public function get($page,$templeid)
	{
		$this->db->select('volunteer.*,temple.name as templename');
		$this->db->from('volunteer');
		$this->db->join('temple','temple.id=volunteer.hostid','left');
		if($templeid != -1)
			$this->db->where('hostid', $templeid);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_index($templeid_arr, $count){
		$this->db->select('v.*, t.name as templename');
		$this->db->from('volunteer v');
		$this->db->join('temple t','t.id = v.hostid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('hostid', $templeid);
		}
		$this->db->limit($count,0);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_list_by_page($templeid_arr, $page){
		$this->db->select('v.*, t.name as templename');
		$this->db->from('volunteer v');
		$this->db->join('temple t','t.id = v.hostid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('templeid', $templeid);
		}
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function search($query,$page,$templeid)
	{
		$this->db->select('v.*,t.name as templename');
		$this->db->from('volunteer v');
		$this->db->join('temple t','v.hostid=t.id','left');
		if($templeid != -1)
			$this->db->where('v.hostid', $templeid);
		$this->db->like('v.title',$query);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function search_page($query,$templeid)
	{
		$this->db->select('count(1)');
		$this->db->from('volunteer');
		if($templeid != -1)
			$this->db->where('hostid', $templeid);
		$this->db->like('title',$query);
		$count = $this->db->count_all_results();
		return ceil ( $count / $this->num_per_page);
	}

	public function get_page($templeid)
	{
		$this->db->select('count(1) as count');
		if($templeid != -1)
			$this->db->where('hostid', $templeid);
		$query = $this->db->get('volunteer');
		return ceil ($query->row()->count / $this->num_per_page);
	}

	public function info($id)
	{
		$this->db->select('v.*,t.name as templename');
		$this->db->join('temple t','v.hostid=t.id','left');
		$this->db->where('v.id',$id);
		$query = $this->db->get('volunteer v');
		return $query->row();
	}

	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('volunteer');
		return TRUE;
	}

	//修改
	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('volunteer',$data);
		return TRUE;
	}

	public function register($data)
	{
		$this->db->insert('volunteer_register',$data);
		return $this->db->insert_id();
	}

	public function add_register_answer($registerid, $questionid, $optionid, $option_detail)
	{
		$data = array('registerid' => $registerid, 'questionid' => $questionid, 'optionid' => $optionid, 'option_detail' => $option_detail);
		$this->db->insert('volunteer_register_answer',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function quit($userid,$volunteerid)
	{
		$this->db->where('userid',$userid);
		$this->db->where('volunteerid',$volunteerid);
		$this->db->delete('volunteer_register');
		return TRUE;
	}

	public function get_register($volunteerid)
	{
		$this->db->select('*');
		$this->db->from('volunteer_register');
		$this->db->where('volunteerid', $volunteerid);
		//$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_register_answer($registerid)
	{
		$this->db->select('*');
		$this->db->from('volunteer_register_answer');
		$this->db->where('registerid', $registerid);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_register_by_user($volunteerid,$userid)
	{
		$this->db->select('*');
		$this->db->from('volunteer_register');
		$this->db->where('volunteerid', $volunteerid);
		$this->db->where('userid', $userid);
		//$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_user($userid)
	{
		$this->db->select('volunteer_register.volunteerid, volunteer_register.registertime, volunteer.id, volunteer.title, temple.id as templeid, temple.name as templename');
		$this->db->from('volunteer_register');
		$this->db->join('volunteer','volunteer.id = volunteer_register.volunteerid');
		$this->db->join('temple','temple.id=volunteer.hostid');
		$this->db->where('userid', $userid);
		//$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function is_register($userid,$volunteerid)
	{
		$this->db->select('*');
		$this->db->where('userid',$userid);
		$this->db->where('volunteerid',$volunteerid);
		$num = $this->db->get('volunteer_register')->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}

	public function add_views($id, $views)
	{
		$this->db->where('id',$id);
		$this->db->update('volunteer',array('views' => $views));
		return TRUE;
	}
}
?>