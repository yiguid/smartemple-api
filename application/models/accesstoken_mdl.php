<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class AccessToken_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	//添加
	public function add($data)
	{
		$this->db->insert('access_token',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function info($userid)
	{
		$this->db->select('*');
        $this->db->from('access_token');
        $this->db->where('userid',$userid);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	public function exist($userid)
	{
		$this->db->select('userid');
		$this->db->where('userid',$userid);
		$num = $this->db->get('access_token')->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}

	public function validate($access_token)
	{
		$this->db->select('expiretime');
		$this->db->where('token',$access_token);
		$query = $this->db->get('access_token');
        $entry = $query->row();
        if(strlen($access_token) == 40 && $entry->expiretime > date('Y-m-d'))
        	return TRUE;
        else
        	return FALSE;
	}
	
	public function update($userid,$data)
	{
		$this->db->where('userid',$userid);
		$this->db->update('access_token',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}
?>