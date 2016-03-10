<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Json_temple_mdl extends CI_Model {
	public function __construct()
	{
		parent:: __construct();
	}

	public function info_get($id)
	{
		$this->db->select('temple.id as templeid,user.id as masterid,temple.name,temple.province,temple.city,temple.master,temple.website,temple.homeimg,master_detail.avatar,temple_qf_count.qfcount as views');
		$this->db->from('temple');		
		$this->db->join('user','user.templeid = temple.id');
		$this->db->join('master_detail','master_detail.masterid = user.id');
		$this->db->join('temple_qf_count','temple_qf_count.templeid = temple.id');
		$this->db->where('temple.closed',0);
		$this->db->where('temple.verified',1);
		$this->db->where('temple.id',$id);	
		$query = $this->db->get();
		return $query->result();
	}

	public function all_get($page, $num_per_page)
	{
		$this->db->select('temple.id as templeid,user.id as masterid,temple.name,temple.province,temple.city,temple.master,temple.website,temple.homeimg,master_detail.avatar,temple_qf_count.qfcount as views');
		$this->db->from('temple');		
		$this->db->join('user','user.templeid = temple.id');
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple_qf_count','temple_qf_count.templeid = temple.id','left');
		$this->db->where('temple.closed',0);
		$this->db->where('temple.verified',1);
		$this->db->where('user.type','master');	
		$this->db->where('master_detail.avatar !=','');		
		$this->db->group_by('temple.id');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function attention_get($templeid_arr, $id, $page, $num_per_page)
	{
		$this->db->select('name,province,city,master');
		$this->db->from('temple');	
		//$this->db->join('user','user.id = temple.id');
		$this->db->where('closed',0);	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function recommend_get($page, $num_per_page)
	{
		$this->db->select('temple.id as templeid,user.id as masterid,temple.name,temple.province,temple.city,temple.master,temple.website,temple.homeimg,master_detail.avatar,temple_qf_count.qfcount as views');
		$this->db->from('temple');		
		$this->db->join('user','user.templeid = temple.id');
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple_qf_count','temple_qf_count.templeid = temple.id','left');
		$this->db->where('temple.closed',0);
		$this->db->where('temple.verified',1);
		$this->db->where('user.type','master');	
		$this->db->where('master_detail.avatar !=','');
		$this->db->order_by('temple.pos','desc');	
		$this->db->group_by('temple.id');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function hot_get($page, $num_per_page)
	{
		$this->db->select('temple.id as templeid,user.id as masterid,temple.name,temple.province,temple.city,temple.master,temple.website,temple.homeimg,master_detail.avatar,temple_qf_count.qfcount as views');
		$this->db->from('temple');		
		$this->db->join('user','user.templeid = temple.id');
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple_qf_count','temple_qf_count.templeid = temple.id','left');
		$this->db->where('temple.closed',0);
		$this->db->where('temple.verified',1);
		$this->db->where('user.type','master');	
		$this->db->where('master_detail.avatar !=','');
		$this->db->order_by('temple_qf_count.qfcount','desc');	
		$this->db->group_by('temple.id');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function search_get($temple_name, $page, $num_per_page)
	{
		$this->db->select('temple.id as templeid,user.id as masterid,temple.name,temple.province,temple.city,temple.master,temple.website,temple.homeimg,master_detail.avatar,temple_qf_count.qfcount as views');
		$this->db->from('temple');		
		$this->db->join('user','user.templeid = temple.id');
		$this->db->join('master_detail','master_detail.masterid = user.id','left');
		$this->db->join('temple_qf_count','temple_qf_count.templeid = temple.id','left');
		$this->db->like('temple.name',$temple_name);	
		$this->db->where('temple.closed',0);
		$this->db->where('temple.verified',1);
		$this->db->where('user.type','master');	
		$this->db->group_by('temple.id');	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function donation_get($id, $page, $num_per_page)
	{
		$this->db->select('*');
		$this->db->from('donation');
		$this->db->where('templeid',$id);
		// switch ($type) {		
		// 	case '1':$this->db->where('type','佛像');break;
		// 	case '2':$this->db->where('type','十大供养');break;
		// 	case '3':$this->db->where('type','建材');break;
		// 	case '4':$this->db->where('type','日行一善');break;
		// 	case '5':$this->db->where('type','灯');break;
		// 	case '6':$this->db->where('type','花木');break;
		// 	case '7':$this->db->where('type','设备');break;
		// 	case '8':$this->db->where('type','随喜');break;
		// 	default:break;
		// }			  	
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function d_zhongchou_get($id, $page, $num_per_page)
	{
		$this->db->select('*');
		$this->db->from('zhongchou');
		$this->db->where('founderid',$id);			  
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function news_get($id, $page, $num_per_page)
	{
		$this->db->select('id,like,title,updatetime,views');
		$this->db->from('news');					
		$this->db->where('templeid',$id);	
		$this->db->order_by('updatetime','desc');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);		
		$query = $this->db->get();
		return $query->result();
	}

	public function activity_get($id, $page, $num_per_page)
	{				
		$this->db->select('id,cost,title,description,inputtime,starttime,endtime,location,views,like');
		$this->db->from('activity');				
		$this->db->where('hostid',$id);	
		$this->db->order_by('inputtime','desc');						
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);	
		$query = $this->db->get();
		return $query->result();
	}

	public function volunteer_get($id, $page, $num_per_page)
	{
		$this->db->select('id,cost,title,description,inputtime,starttime,endtime,location,views,like');
		$this->db->from('volunteer');		
		$this->db->where('hostid',$id);	
		$this->db->order_by('inputtime','desc');
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);					        
		$query = $this->db->get();
		return $query->result();
	}

	public function wish_get($id, $page, $num_per_page)
	{
		$this->db->select('userid,content,donationcontent,datetime,location');	
		$this->db->from('wishboard');		
		$this->db->where('templeid',$id);
		$this->db->where('status',1);
		$this->db->where('parentid',0);
		$this->db->order_by('datetime','desc');				
		$this->db->limit($num_per_page,($page - 1) * $num_per_page);						
		$query = $this->db->get();
		return $query->result();
	}

	public function views_add($id)
	{
		$this->db->set('','+1',false);
	 	$this->db->where('templeid',$id); 
		$this->db->update('');                                            
	}

	public function message_insert($data)
	{
		$this->db->insert('wishboard',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_income_count($templeid,$rolltime = 'all')
	{
		//原有的是统计的供养的物品总数量，实际应该是总人数，一个订单可能有多个物品供养
		// $this->db->select('sum(do.total) as income, sum(toic.count) as count');
		$this->db->select('sum(do.total) as income, count(do.total) as count');
        $this->db->from('donation_order do');
        // $this->db->join('temple_order_item_count toic','do.id=toic.orderid');
        if($templeid != 0)
        	$this->db->where('templeid',$templeid);
        $this->db->where('status','支付成功');
        //这里不能直接or，要限定templeid了再or
        //$this->db->or_where('status','登记成功');
        //只显示本月的month，只显示本日的day
        if($rolltime == 'month'){
        	$date_str = date("Y-m");
			$this->db->where('do.ordertime >',$date_str);
        }else if($rolltime == 'day'){
        	$date_str = date("Y-m-d");
			$this->db->where('do.ordertime >',$date_str);
        }else{
        	//全部显示，不执行
        	;
        }

        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}
}
?>