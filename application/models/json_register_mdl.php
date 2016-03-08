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

	public function add($data)
	{
		$this->db->insert('user',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}
?>