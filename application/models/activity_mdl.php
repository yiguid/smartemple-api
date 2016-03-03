<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Activity_mdl extends CI_Model {
	public $num_per_page = 15;
	public function __construct()
	{
		parent:: __construct();

	}

	//添加
	public function add($data)
	{
		$this->db->insert('activity',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function add_cat($data)
	{
		$this->db->insert('activity_category',$data);
		return $this->db->insert_id();
	}

	//获取
	//templeid = 0 的都是admin添加的新闻
	//templeid = -1 获取全部新闻
	public function get($page,$templeid)
	{
		$this->db->select('activity.*,temple.name as templename');
		$this->db->from('activity');
		$this->db->join('temple','temple.id=activity.hostid','left');
		if($templeid != -1)
			$this->db->where('hostid', $templeid);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_cat($templeid)
	{
		$this->db->select('*');
		$this->db->from('activity_category');
		$this->db->where('hostid',$templeid);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_index($templeid_arr, $count){
		$this->db->select('a.*, t.name as templename');
		$this->db->from('activity a');
		$this->db->join('temple t','t.id = a.hostid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('a.hostid', $templeid);
		}
		$this->db->limit($count,0);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_list_by_page($templeid_arr, $page){
		$this->db->select('a.*, t.name as templename');
		$this->db->from('activity a');
		$this->db->join('temple t','t.id = a.hostid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('a.hostid', $templeid);
		}
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function search($query,$page,$templeid)
	{
		$this->db->select('activity.*,temple.name as templename');
		$this->db->from('activity');
		$this->db->join('temple','temple.id=activity.hostid','left');
		if($templeid != -1)
			$this->db->where('activity.hostid', $templeid);
		$this->db->like('title',$query);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function search_page($query,$templeid)
	{
		$this->db->select('count(1)');
		$this->db->from('activity');
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
		$query = $this->db->get('activity');
		return ceil ($query->row()->count / $this->num_per_page);
	}

	public function info($id)
	{
		$this->db->select('a.*,ac.name as catname,t.name as templename');
		$this->db->join('activity_category ac','a.catid=ac.id','left');
		$this->db->join('temple t','a.hostid=t.id','left');
		$this->db->where('a.id',$id);
		$query = $this->db->get('activity a');
		return $query->row();
	}

	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('activity');
		return TRUE;
	}

	public function delete_cat($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('activity_category');
		return TRUE;
	}

	//修改
	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('activity',$data);
		return TRUE;
	}

	public function update_cat($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('activity_category',$data);
		return TRUE;
	}

	public function register($data)
	{
		$this->db->insert('activity_register',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function quit($userid,$activityid)
	{
		$this->db->where('userid',$userid);
		$this->db->where('activityid',$activityid);
		$this->db->delete('activity_register');
		return TRUE;
	}

	public function get_register($activityid)
	{
		$this->db->select('*');
		$this->db->from('activity_register');
		$this->db->where('activityid', $activityid);
		//$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_by_user($userid)
	{
		$this->db->select('activity_register.activityid, activity_register.registertime, activity.id, activity.title, temple.id as templeid, temple.name as templename');
		$this->db->from('activity_register');
		$this->db->join('activity','activity.id = activity_register.activityid');
		$this->db->join('temple','temple.id=activity.hostid');
		$this->db->where('userid', $userid);
		//$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function is_register($userid,$activityid)
	{
		$this->db->select('*');
		$this->db->where('userid',$userid);
		$this->db->where('activityid',$activityid);
		$num = $this->db->get('activity_register')->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}

	public function add_views($id, $views)
	{
		$this->db->where('id',$id);
		$this->db->update('activity',array('views' => $views));
		return TRUE;
	}
}
?>