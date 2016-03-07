<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Timeline_mdl extends CI_Model {
	public $num_per_page = 15;
	public function __construct()
	{
		parent:: __construct();

	}

	//添加
	public function add($data)
	{
		$this->db->insert('timeline',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}


	//获取
	public function get($page, $templeid)
	{
		$this->db->select('timeline.*,temple.name as templename,wechatvoice.serverId as voiceServerId');
		$this->db->from('timeline');
		$this->db->join('temple','temple.id=timeline.templeid','left');
		$this->db->join('wechatvoice','wechatvoice.id=timeline.voiceid','left');
		if($templeid != -1)
			$this->db->where('timeline.templeid', $templeid);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$this->db->order_by('datetime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//type = 0, all timeline
	//type = 1, master timeline
	//type = 2, temple timeline
	public function get_list_by_page($templeid_arr, $page, $type = 0){
		$this->db->select('timeline.*, t.name as templename');
		$this->db->from('timeline');
		$this->db->join('temple t','t.id = timeline.templeid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('timeline.templeid', $templeid);
		}
		if($typeid > 0)
			$this->db->where('timeline.type',$typeid);
		//typeid == 0, all news
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$this->db->order_by('datetime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function search($query,$page,$templeid)
	{
		$this->db->select('timeline.*,temple.name as templename');
		$this->db->from('timeline');
		$this->db->join('temple','temple.id=timeline.templeid','left');
		if($templeid != -1)
			$this->db->where('templeid',$templeid);
		$this->db->like('message',$query);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function search_page($query,$templeid)
	{
		$this->db->select('count(1)');
		$this->db->from('timeline');
		if($templeid != -1)
			$this->db->where('templeid',$templeid);
		$this->db->like('message',$query);
		$count = $this->db->count_all_results();
		return ceil ( $count / $this->num_per_page);
	}

	public function get_page($templeid)
	{
		$this->db->select('count(1) as count');
		if($templeid != -1)
			$this->db->where('templeid',$templeid);
		$query = $this->db->get('timeline');
		return ceil ($query->row()->count / $this->num_per_page);
	}

	public function info($id)
	{
		$this->db->select('tl.*, t.name as templename, u.realname as mastername');
		$this->db->from('timeline tl');
		$this->db->join('temple t','t.id = tl.templeid','left');
		$this->db->join('user u','u.id = tl.masterid','left');
		$this->db->where('tl.id',$id);
		$query = $this->db->get('timeline');
		return $query->row();
	}

	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('timeline');
		return TRUE;
	}

	//修改
	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('timeline',$data);
		return TRUE;
	}

	public function add_daily_timeline($data)
	{
		$this->db->select('*');
		$date_str = date("Y-m-d");
		$this->db->where('datetime',$date_str);
		$this->db->where('templeid',$data['templeid']);
		$this->db->where('masterid',$data['masterid']);
		$query = $this->db->get('timeline');
		$entry = $query->row();
		if(isset($entry->id))
			$this->update($entry->id,$data);
		else
			$this->add($data);
	}
}
?>