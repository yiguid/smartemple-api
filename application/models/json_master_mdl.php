<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_master_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();
	}

	public function all_get($page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id','left');	
		$this->db->join('temple','temple.id = user.templeid');
		$this->db->where('user.type','master');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);			
		$query = $this->db->get();
		return $query->result();
	}

	public function recommend_get($page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple','temple.id = user.templeid');	
		$this->db->where('user.type','master');	
		$this->db->order_by('master_detail.pos','desc');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function hot_get($page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple','temple.id = user.templeid');						
		$this->db->where('user.type','master');
		$this->db->order_by('master_detail.views','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}

	public function search_get($master_name, $page, $num_per_page)
	{
		$this->db->select('user.id,user.realname,master_detail.avatar,master_detail.views,temple.name');
		$this->db->from('user');	
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple','temple.id = user.templeid');	
		$this->db->like('user.realname',$master_name);		
		$this->db->where('user.type','master');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function timeline_get($id, $page, $num_per_page)
	{
		$this->db->select('*');
		$this->db->from('timeline');						
		$this->db->where('masterid',$id);
		$this->db->order_by('datetime','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}

	public function voice_get($id, $page, $num_per_page)
	{
		$this->db->select('wechatvoice.*,temple.name');
		$this->db->from('wechatvoice');			
		$this->db->join('temple','temple.id = wechatvoice.templeid');			
		$this->db->where('wechatvoice.userid',$id);
		$this->db->order_by('wechatvoice.datetime','desc');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}

	public function question_get($id, $page, $num_per_page)
	{
		$this->db->select('w1.userid as master, w1.content as answer, w2.userid as user, w2.content as question, w2.location as location');
        $this->db->from('wishboard w1');
        $this->db->join('wishboard w2','w1.parentid=w2.id');
        $this->db->where('w1.templeid', $id);
        $this->db->where('w1.usertype', 'master');
        $this->db->where('w2.status',1);
        $this->db->order_by('w1.datetime','desc');
        $this->db->limit($num_per_page,($page - 1) * $num_per_page);        
        $query = $this->db->get();
        return $query->result();
	}
}
?>