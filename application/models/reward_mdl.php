<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Reward_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();

	}

	//添加
	public function add($data)
	{
		$this->db->insert('zhongchou_reward',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}


	//获取zhongchouid与rewardid相匹配
	public function get($zhongchouid)
	{
		$this->db->select('*');
		$this->db->from('zhongchou_reward');
		$this->db->where('zhongchouid',$zhongchouid);
		$query = $this->db->get();
		return $query->result();
	}

	//获取捐款人与被捐款项目信息
	public function get_history($userid)
	{
		$this->db->select('r.*,z.title as zhongchoutitle,zr.recordtime');
		$this->db->from('zhongchou_record zr');
		$this->db->join('zhongchou_reward r','r.id=zr.rewardid');
		$this->db->join('zhongchou z','z.id=r.zhongchouid');
		$this->db->where('userid',$userid);
		$query = $this->db->get();
		return $query->result();
	}

	public function info($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('zhongchou_reward');
		return $query->row();
	}

	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('zhongchou_reward');
		return TRUE;
	}

	//修改
	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('zhongchou_reward',$data);
		return TRUE;
	}

}
?>