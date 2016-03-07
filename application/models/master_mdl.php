<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Master_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	//获取法师
	public function get_show()
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views');
		$this->db->from('user');
		$this->db->join('master_detail','user.id = master_detail.masterid');
		$this->db->where('user.type','master');
		$this->db->where('master_detail.pos >=',1);
		$this->db->where('master_detail.avatar !=','');
		$this->db->group_by('user.id');
		$this->db->order_by('pos','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_index_show($count = 10)
	{
		$this->db->select('user.id,user.templeid,user.realname,max(wechatvoice.datetime) as time, master_detail.avatar,master_detail.views');
		$this->db->from('wechatvoice');
		$this->db->join('user','wechatvoice.userid=user.id','left');
		$this->db->join('master_detail','user.id = master_detail.masterid');
		$this->db->where('user.type','master');
		$this->db->where('master_detail.pos >=',1);
		$this->db->where('master_detail.avatar !=','');
		$this->db->where('wechatvoice.type',1);
		$date_str = date("Y-m-d");
		$date_str = date('Y-m-d',strtotime("$date_str - 3 day"));
		$this->db->where('wechatvoice.datetime >',$date_str);
		$this->db->group_by('wechatvoice.userid');
		$this->db->order_by('pos','desc');
		$this->db->order_by('time','desc');
		$this->db->limit($count);
		$query = $this->db->get();
		return $query->result();
	}

	//获取后台推荐的法师
	public function get_rec($count)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('master_detail','user.id = master_detail.masterid');
		$this->db->where('user.type', 'master');
		$this->db->where('master_detail.pos',1);
		$this->db->limit($count,0);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_index($count){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('master_detail','user.id = master_detail.masterid');
		$this->db->where('user.type', 'master');
		$this->db->limit($count,0);
		$query = $this->db->get();
		return $query->result();
	}

	//添加法师
	public function add($data)
	{
		$this->db->insert('user',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function add_detail($data)
	{
		$this->db->insert('master_detail',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function info($id)
	{
		$this->db->select('*');
        $this->db->from('user');
        $this->db->join('master_detail','user.id = master_detail.masterid');
        $this->db->where('user.id',$id);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	public function global_search($q)
	{
		$this->db->select('*');
        $this->db->from('user');
        $this->db->join('master_detail','user.id = master_detail.masterid');
		$this->db->like('user.realname',$q);
		$query = $this->db->get();
		return $query->result();
	}

	//获取法师
	public function get($verified = 1)
	{
		$this->db->select('user.*,temple.name as templename, master_detail.*');
		$this->db->from('user');
		$this->db->join('master_detail','user.id = master_detail.masterid');
		$this->db->where('user.type','master');
		$this->db->where('master_detail.verified',$verified);
		$this->db->join('temple','temple.id=user.templeid','left');
		$this->db->order_by('user.id','desc');
		//$this->db->join('userpermission','userpermission.username = userinfo.username');
		$query = $this->db->get();
		return $query->result();
	}

	//检测法师是否有管理的寺院
	public function is_master($username)
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('templeid',0);
		$this->db->where('type','master');
		$num = $this->db->get('user')->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}

	//修改
	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('user',$data);
		return TRUE;
	}

	public function update_detail($id, $data)
	{
		$this->db->where('masterid',$id);
		$this->db->update('master_detail',$data);
		return TRUE;
	}

	//删除法师
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('user');
		return TRUE;
	}

	public function add_views($id, $views)
	{
		$this->db->where('masterid',$id);
		$this->db->update('master_detail',array('views' => $views));
		return TRUE;
	}
}
?>