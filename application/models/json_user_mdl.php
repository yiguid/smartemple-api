<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_user_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();
	}
//$headers = $this->input->request_headers();return sha1(md5($username.$password.microtime()));
	public function donation_get($id, $page, $num_per_page)
	{
		$this->db->select('donation_order.id,donation_order.ordertime,donation_order.total,donation_order.status,temple.name');
		$this->db->from('donation_order');	
		$this->db->join('temple',"temple.id = donation_order.templeid");
		$this->db->join('user',"user.username = donation_order.username");		
		$this->db->where('user.id',$id);
		$this->db->order_by('ordertime','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);					
		$query = $this->db->get();
		return $query->result();
	}

	public function donation_zhongchou_get($id, $page, $num_per_page)
	{
		$this->db->select('zhongchou_record.id,zhongchou.title,zhongchou_record.recordtime,zhongchou_record.rewardstatus');	
		$this->db->from('zhongchou_record');		
		$this->db->join('zhongchou_reward',"zhongchou_reward.id = zhongchou_record.rewardid");
		$this->db->join('zhongchou',"zhongchou.id = zhongchou_reward.zhongchouid");			
		$this->db->where('zhongchou_record.userid',$id);
		$this->db->order_by('recordtime','desc');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);						
		$query = $this->db->get();
		return $query->result();
	}

	public function wish_get($id, $page, $num_per_page)
	{
		$this->db->select('w.content,w.datetime,temple.name');	
		$this->db->from('wishboard w');		
		$this->db->join('temple',"temple.id = w.templeid");
		$this->db->where('w.userrealid',$id);
		$this->db->where('w.parentid',0);
		$this->db->order_by('w.datetime','desc');			
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);						
		$query = $this->db->get();
		return $query->result();
	}

	public function activity_get($id, $page, $num_per_page)
	{
		$this->db->select('activity.id,activity.title');
		$this->db->from('activity');
		$this->db->join('activity_register',"activity_register.activityid = activity.id");	
		$this->db->where('activity_register.userid',$id);
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);				        
		$query = $this->db->get();
		return $query->result();
	}

	public function volunteer_get($id, $page, $num_per_page)
	{
		$this->db->select('volunteer.id,volunteer.title');
		$this->db->from('volunteer');
		$this->db->join('volunteer_register',"volunteer_register.volunteerid = volunteer.id");	
		$this->db->where('volunteer_register.userid',$id);
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);					        
		$query = $this->db->get();
		return $query->result();
	}

	public function info_get($id)
	{
		$this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_detail','user.id=user_detail.userid');
        $this->db->where('user.id',$id);
        $query = $this->db->get();   
        return $query->result();
	}

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
}
?>