<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_register_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();	
	}

	public function exist($username)
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$num = $this->db->get('user')->num_rows();
		return ($num > 0) ? TRUE : FALSE;
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

	public function regist($data){
		return $this->add($data);
	}
}
?>