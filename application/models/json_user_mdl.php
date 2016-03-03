<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_user_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();
	}
//$headers = $this->input->request_headers();return sha1(md5($username.$password.microtime()));
	public function donation_get($id, $page, $num_per_page)
	{
		$this->db->select('donation_order.ordertime,donation_order.total,donation_order.status,temple.name');
		$this->db->from('donation_order');	
		$this->db->join('temple',"temple.id = donation_order.templeid");
		$this->db->join('user',"user.username = donation_order.username");
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$this->db->order_by('ordertime','desc');	
		$this->db->where('user.id',$id);			
		$query = $this->db->get();
		return $query->result();
	}

	public function donation_zhongchou_get($id, $page, $num_per_page)
	{
		$this->db->select('zhongchou_reward.money,zhongchou_reward.award,zhongchou_record.recordtime,zhongchou_record.status,zhongchou_record.rewardstatus');	
		$this->db->from('zhongchou_record');		
		$this->db->join('zhongchou_reward',"zhongchou_reward.id = zhongchou_record.rewardid");
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$this->db->order_by('recordtime','desc');	
		$this->db->where('zhongchou_record.userid',$id);		
		$query = $this->db->get();
		return $query->result();
	}

	public function activity_get($id, $page, $num_per_page)
	{
		$this->db->select('title');
		$this->db->from('activity');
		$this->db->join('activity_register',"activity_register.activityid = activity.id");	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$this->db->where('activity_register.userid',$id);		        
		$query = $this->db->get();
		return $query->result();
	}

	public function volunteer_get($id, $page, $num_per_page)
	{
		$this->db->select('title');
		$this->db->from('volunteer');
		$this->db->join('volunteer_register',"volunteer_register.volunteerid = volunteer.id");	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$this->db->where('volunteer_register.userid',$id);		        
		$query = $this->db->get();
		return $query->result();
	}
}
?>