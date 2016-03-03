<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Zhongchou_mdl extends CI_Model {
	public $num_per_page = 12;
	public function __construct()
	{
		parent:: __construct();
	}

	//添加
	public function add($data)
	{
		$this->db->insert('zhongchou',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}


	//获取
	//founderid 在这里就是templeid
	public function get($page,$founderid)
	{
		$this->db->select('zhongchou.*, t.name as templename');
		$this->db->from('zhongchou');
		$this->db->join('temple t','t.id = zhongchou.founderid','left');
		if($founderid != -1)
			$this->db->where('founderid', $founderid);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_index($templeid_arr, $count){
		$this->db->select('z.*, t.name as templename');
		$this->db->from('zhongchou z');
		$this->db->join('temple t','t.id = z.founderid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('z.founderid', $templeid);
		}
		$this->db->limit($count,0);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	
	public function search($query,$page,$founderid)
	{
		$this->db->select('zhongchou.*, t.name as templename');
		$this->db->from('zhongchou');
		$this->db->join('temple t','t.id = zhongchou.founderid','left');
		$this->db->like('title',$query);
		if($founderid != -1)
			$this->db->where('founderid', $founderid);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function search_page($query,$founderid)
	{
		$this->db->select('count(1)');
		$this->db->from('zhongchou');
		$this->db->like('id',$query);
		$this->db->like('title',$query);
		if($founderid != -1)
			$this->db->where('founderid', $founderid);
		$count = $this->db->count_all_results();
		return ceil ( $count / $this->num_per_page);
	}

	public function get_page($founderid)
	{
		$this->db->select('count(1) as count');
		if($founderid != -1)
			$this->db->where('founderid', $founderid);
		$query = $this->db->get('zhongchou');
		return ceil ($query->row()->count / $this->num_per_page);
	}

	public function info($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('zhongchou');
		return $query->row();
	}

	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('zhongchou');
		return TRUE;
	}

	//修改
	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('zhongchou',$data);
		return TRUE;
	}

	public function add_views($id, $views)
	{
		$this->db->where('id',$id);
		$this->db->update('zhongchou',array('views' => $views));
		return TRUE;
	}

	//需要有id，数据库改为varchar，id是生成的编号
	public function support($userid,$rewardid)
	{
		$recordtime = date("Y-m-d H:i:s",time());
		$data = array(
			'id' => "Z".date("YmdHis").substr(md5($recordtime),0,6),
			'userid' => $userid,
			'rewardid' => $rewardid,
			'recordtime' => $recordtime
			);
		$this->db->insert('zhongchou_record',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function add_record($data)
	{
		$this->db->insert('zhongchou_record',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function update_record($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('zhongchou_record',$data);
		return TRUE;
	}

	public function info_record($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('zhongchou_record');
		return $query->row();
	}

	public function get_donator_list($id)
	{
		//查出reward ids
		$this->db->select('id');
		$this->db->from('zhongchou_reward');
		$this->db->where('zhongchouid',$id);
		$query = $this->db->get();
		$rewards = $query->result();
		$rewardids = array();
		foreach ($rewards as $reward) {
			$rewardids[] = $reward->id;
		}
		if(count($rewardids) != 0){
			//根据reward ids，查zhongchou_record中的捐助情况
			$this->db->select('u.realname,zr.recordtime,zr.id,r.money,r.award,r.id as rewardid');
			$this->db->from('zhongchou_record zr');
			$this->db->join('user u','u.id=zr.userid');
			$this->db->join('zhongchou_reward r','r.id=zr.rewardid');
			$this->db->where('zr.status','支付成功');
			$this->db->where_in('zr.rewardid',$rewardids);
			$this->db->order_by('zr.recordtime','desc');
			$query = $this->db->get();
			return $query->result();
		}
		else
			return array();
	}

}
?>