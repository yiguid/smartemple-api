<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Message_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	public function get_message($id,$type = 1)
	{
		if($type == 2)
		{
			$type_str = from;	
			$type_str1 = to;	
		}			
		else
		{
			$type_str = to;	
			$type_str1 = from;	
		}	
		$this->db->select('message.*, user.username');
		$this->db->from('message');			
		$this->db->join('user','user.id=message.'.$type_str,'left');
		$this->db->where($type_str1,$id);
		$this->db->order_by('time','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function ajax_issue()
	{
		$q = strtolower($_GET["term"]);		
		$query = mysql_query("select * from user where username like '$q%' limit 0,10");
		while ($row = mysql_fetch_array($query)) {
		$result[] = array(
			    'id' => $row['id'],
			    'label' => $row['username']
		);
		}
		return json_encode($result);
	}

	public function data_issue($username,$content)
	{
		$id = $this->session->userdata('id');
		$this->db->select('id');
		$this->db->where('username',$username);
		$query = $this->db->get('user');
        $entry = $query->row();
		if(isset($entry->id)){
			$this->db->insert('message',array('from'=>$id,'to' =>$entry->id,'content'=>$content));
		}else{
        	return $username."用户名不存在！";
		}
		
	}

	public function u_message($id, $page){        
        $this->db->select('message.*, user.username');
        $this->db->from('message');         
        $this->db->join('user','user.id=message.from','left');        
        $this->db->where('to',$id);
        $this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
        $this->db->order_by('time','desc');       
        $query = $this->db->get();
        return $query->result();
    }

    public function data_issue($username,$content)
    {
        $id = $this->session->userdata('id');
        $this->db->select('id');
        $this->db->where('username',$username);
        $query = $this->db->get('user');
        $entry = $query->row();
        if(isset($entry->id)){
            $this->db->insert('message',array('from'=>$id,'to' =>$entry->id,'content'=>$content));        
            return "回复成功！";
        }        
    }

    public function delete_ms($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('message');
        return TRUE;
    }

    public function get_page($id)
    {
        $this->db->select('count(1) as count');  
        $this->db->where('to',$id);      
        $query = $this->db->get('message');
        return ceil ($query->row()->count / $this->num_per_page);
    }
}
?>