<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Temple_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	//添加
	public function add($data)
	{
		$this->db->insert('temple',$data);
		return $this->db->insert_id();
	}

	//检测信息是否已经存在
	public function exist($info)
	{
		$this->db->select('*');
		$this->db->where('name',$info);
		$this->db->or_where('englishname',$info);
		$num = $this->db->get('temple')->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}

	//列表
	public function get()
	{
		$this->db->select('*');
		$this->db->from('temple');
		//$this->db->join('temple_space_count','temple_space_count.templeid=temple.id','left');
		$this->db->join('temple_donation_count','temple_donation_count.templeid=temple.id','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_stick()
	{
		$this->db->select('id');
		$this->db->from('temple');
		$this->db->where('pos','1');
		$query = $this->db->get();
		return $query->result();
	}

	//列表
	public function get_index($templeid_arr, $count)
	{
		$this->db->select('*');
		$this->db->from('temple');
		//$this->db->join('temple_space_count','temple_space_count.templeid=temple.id','left');
		$this->db->join('temple_donation_count','temple_donation_count.templeid=temple.id','left');
		$this->db->join('temple_qf_count','temple_qf_count.templeid=temple.id','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('temple.id', $templeid);
		}
		$this->db->limit($count,0);
		$this->db->order_by('temple_qf_count.qfcount','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function info($id)
	{
		$this->db->select('*');
        $this->db->from('temple');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	//危险，不能乱用
	public function clear_donation($templeid = '')
	{
		$this->db->empty_table('donation');
		$this->db->empty_table('donation_order');
		$this->db->empty_table('donation_order_item');
	}

	public function get_by_temple_englishname($temple_englishname)
	{
		$this->db->select('*');
        $this->db->from('temple');
        $this->db->where('englishname',$temple_englishname);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	public function get_by_temple_province($province)
	{
		$this->db->select('*');
        $this->db->from('temple');
        $this->db->like('province',$province);
        $query = $this->db->get();
        return $query->result();
	}

	public function get_temple_map()
	{
		$this->db->select('province, count(id) as total');
        $this->db->from('temple');
        $this->db->group_by('province');
        $query = $this->db->get();
        return $query->result();
	}
	
	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('temple');
		return TRUE;
	}

	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('temple',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_master($id)
	{
		$this->db->select('*');
        $this->db->from('user');
        $this->db->where('templeid',$id);
        $this->db->where('type','master');
        $query = $this->db->get();
		return $query->result();
	}

	public function add_master($id,$username)
	{
		$this->db->where('username',$username);
		$this->db->update('user',array('templeid' => $id));
		return '添加成功';
	}
}
?>