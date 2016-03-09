<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('user');
		$result = $query->row();
		$num = $query->num_rows();

		if($num == 0)
		{
			return FALSE;
		}
		else
		{
			//存储用户是否填完了详细信息
			$userdetail = $this->check_user_detail($result->id);
			$session_data = array(
				'id' => $result->id,
				'username' => $result->username,
				'realname' => $result->realname,
				'usertype' => $result->type,
				'templeid' => $result->templeid,
				'userdetail' => $userdetail
				);
			 $this->session->set_userdata($session_data);
		}
		//只有用户的修改templeid
		//如果是从页面直接登入的，忽略用户原有的templeid
		if($result->type == 'user' && $this->session->userdata('page_templeid') != null)
			$this->session->set_userdata('templeid',$this->session->userdata('page_templeid'));
		return TRUE;
	}

	public function login_with_username($username){
		$this->db->select('*');
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		$result = $query->row();
		$num = $query->num_rows();

		if($num == 0)
		{
			return FALSE;
		}
		else
		{
			$session_data = array(
				'id' => $result->id,
				'username' => $result->username,
				'realname' => $result->realname,
				'usertype' => $result->type,
				'templeid' => $result->templeid
				);
			 $this->session->set_userdata($session_data);
		}
		//只有用户的修改templeid
		if($result->type == 'user' && $this->session->userdata('page_templeid') != null)
			$this->session->set_userdata('templeid',$this->session->userdata('page_templeid'));
		return TRUE;
	}

	//检测是否是admin
	public function admin($username)
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		$result = $query->row();
		$num = $query->num_rows();
		if($num == 0)
			return FALSE;
		else
		{
			if($result->type == 'admin')
			{
				return TRUE;
			}
			return FALSE;
		}
	}

	//检测是否具有该页面访问权限
	public function check_permit($username,$page)
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$query = $this->db->get('userpermission');
		$result = $query->row();
		$num = $query->num_rows();
		if($num == 0)
			return FALSE;
		else
		{
			if($result->$page == 1)
			{
				return TRUE;
			}
			return FALSE;
		}
	}

	public function regist($data){
		return $this->add($data);
	}

	//添加用户
	public function add($data)
	{
		$this->db->insert('user',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function info($id)
	{
		$this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_detail','user.id=user_detail.userid','left');
        $this->db->where('user.id',$id);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	//检查用户信息是否齐全
	public function check_user_detail($id)
	{
		$this->db->select('*');
        $this->db->from('user_detail');
        $this->db->where('userid',$id);
        $query = $this->db->get();
        $entry = $query->row();
        if($entry == null || $entry->idcard == null || $entry->mobile == null)
        	return false;
        else
        	return true;
	}

	//获取用户表(包括权限)
	public function get()
	{
		$this->db->select('user.*,temple.name as templename');
		$this->db->from('user');
		$this->db->join('temple','temple.id=user.templeid','left');
		$this->db->order_by('user.id','desc');
		//$this->db->join('userpermission','userpermission.username = userinfo.username');
		$query = $this->db->get();
		return $query->result();
	}

	//检测信息是否已经存在
	public function exist($username)
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$num = $this->db->get('user')->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}

	//检测用户是否有管理的寺院
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
		$this->db->select('*');
		$this->db->where('userid',$id);
		$num = $this->db->get('user_detail')->num_rows();
		if($num > 0){
			$this->db->where('userid',$id);
			$this->db->update('user_detail',$data);
		}
		else{
			$data['userid'] = $id;
			$this->db->insert('user_detail',$data);
			return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
		}

		return TRUE;
	}

	//删除用户
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('user');
		return TRUE;
	}

	//修改用户密码
	public function password($old_password,$password,$username)
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('password',$old_password);
		$query = $this->db->get('user');
		$result = $query->row();
		$num = $query->num_rows();

		if($num == 0)
		{
			return FALSE;
		}
		else
		{
			$data = array('password' => $password);
			$this->db->where('username',$username);
			if($this->db->update('user',$data))
				return TRUE;
			else 
				return FALSE;
		}
	}

	public function info_username($username)
	{
		$this->db->select('user.id,user.username,user.realname,user.type,user.templeid,user.registtime,user_detail.*');
        $this->db->from('user');
        $this->db->join('user_detail','user.id=user_detail.userid','left');
        $this->db->where('user.username',$username);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}
}
?>