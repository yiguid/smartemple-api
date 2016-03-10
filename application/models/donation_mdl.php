<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Donation_mdl extends CI_Model {

	public $num_per_page = 15;
	public function __construct()
	{
		parent:: __construct();
	}

	//添加
	public function add($data)
	{
		$this->db->insert('donation',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	//为新添加寺院增加默认的供养
	public function insert_default_data($templeid)
	{
		$data = array(
			array('templeid'=>$templeid, 'name'=>'砖瓦', 'type'=>'建材',
					'info'=>'修建寺院屋檐', 'price'=>5, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'沙土', 'type'=>'建材',
					'info'=>'修建寺院外墙', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'行道树', 'type'=>'花木',
					'info'=>'杨树樟树等', 'price'=>1000, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'殿堂花', 'type'=>'花木',
					'info'=>'菊花月季等', 'price'=>200, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'果品饮料', 'type'=>'十大供养',
					'info'=>'代表感谢佛慈恩德', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'七宝', 'type'=>'十大供养',
					'info'=>'金银琉璃玛瑙砗磲珍珠珊瑚', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'梵乐', 'type'=>'十大供养',
					'info'=>'代表禅定愉悦', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'宝盖', 'type'=>'十大供养',
					'info'=>'代表佛佑天下众生', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'幢', 'type'=>'十大供养',
					'info'=>'为众生谋福利', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'幡', 'type'=>'十大供养',
					'info'=>'号履三千', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'净水', 'type'=>'十大供养',
					'info'=>'慈悲平静', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'佛灯', 'type'=>'十大供养',
					'info'=>'代表佛光普照', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'敬香', 'type'=>'十大供养',
					'info'=>'代表无我利他', 'price'=>1, 'amount'=>1000),
			array('templeid'=>$templeid, 'name'=>'供花', 'type'=>'十大供养',
					'info'=>'代表般若波罗蜜', 'price'=>1, 'amount'=>1000)
		);
		$this->db->insert_batch('donation', $data);
	}

	public function add_order($data)
	{
		$this->db->insert('donation_order',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function add_order_item($data)
	{
		$this->db->insert('donation_order_item',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	//列表
	public function get_order($username = '', $templeid = 0)
	{
		$this->db->select('donation_order.*,temple.name as templename');
		$this->db->from('donation_order');
		if($templeid != 0 ){
			$this->db->where('templeid',$templeid);
		}
		if($username != '' )
			$this->db->where('username',$username);
		$this->db->join('temple','temple.id=donation_order.templeid');
		$this->db->order_by('ordertime','desc');
		$this->db->order_by('templeid','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//列表
	public function get_recent_order($templeid = 0)
	{
		$this->db->select('donation_order.*,temple.name as templename');
		$this->db->from('donation_order');
		if($templeid != 0 ){
			$this->db->where('templeid',$templeid);
		}
		//$this->db->where('status','支付成功');
		$this->db->join('temple','temple.id=donation_order.templeid');
		$this->db->order_by('ordertime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_recent_roll($templeid_arr, $page, $ispaid){
		$this->db->select('do.*, t.name as templename');
		$this->db->from('donation_order do');
		$this->db->join('temple t','t.id = do.templeid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('do.templeid', $templeid);
		}
		if($ispaid == TRUE)
			$this->db->like('do.status','成功');
		$this->db->limit($this->num_per_page,($page - 1)*$this->num_per_page);
		$this->db->order_by('ordertime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_temple_order_income($templeid,$rolltime = 'all')
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

	public function get_order_info($orderid)
	{
		$this->db->select('*');
        $this->db->from('donation_order');
        $this->db->where('id',$orderid);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	public function get_order_items($orderid)
	{
		$this->db->select('*');
		$this->db->from('donation_order_item doi');
		$this->db->join('donation d','d.id = doi.donationid');
		$this->db->where('orderid',$orderid);
		$query = $this->db->get();
		return $query->result();
	}

	//列表
	public function get($templeid = 0)
	{
		$this->db->select('*');
		$this->db->from('donation');
		if($templeid != 0 )
			$this->db->where('templeid',$templeid);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_index($templeid_arr, $count){
		$this->db->select('d.*, t.name as templename');
		$this->db->from('donation d');
		$this->db->join('temple t','t.id = d.templeid');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('templeid', $templeid);
		}
		$this->db->limit($count,0);
		$this->db->order_by('soldcount','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//列表
	public function get_by_type($templeid = 0,$type = '')
	{
		$this->db->select('*');
		$this->db->from('donation');
		if($templeid != 0 )
			$this->db->where('templeid',$templeid);
		if($type != '')
			$this->db->where('type',$type);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_available($templeid = 0)
	{
		$this->db->select('*');
		$this->db->from('donation');
		if($templeid != 0 )
			$this->db->where('templeid',$templeid);
		$this->db->where('amount > ','soldcount');
		$query = $this->db->get();
		return $query->result();
	}

	public function info($id)
	{
		$this->db->select('*');
        $this->db->from('donation');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	public function get_by_id_and_templeid($id,$templeid)
	{
		$this->db->select('*');
        $this->db->from('donation');
        $this->db->where('id',$id);
        $this->db->where('templeid',$templeid);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	public function get_donation_contact_list($id)
	{
		$this->db->select('contact');
		$this->db->from('donation_order_item tdoi');
        $this->db->join('donation_order tdo','tdo.id=tdoi.orderid');
        $this->db->where('tdoi.donationid',$id);
        $query = $this->db->get();
		return $query->result();
	}
	
	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('donation');
		return TRUE;
	}

	//删除订单
	public function delete_order($orderid)
	{
		$this->db->where('id',$orderid);
		$this->db->delete('donation_order');
		$this->db->where('orderid',$orderid);
		$this->db->delete('donation_order_item');
		return TRUE;
	}

	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('donation',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function update_order($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('donation_order',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function update_soldcount($donationid)
	{
		//统计成功的donationid的soldcount
		$this->db->select('sum(count) as soldcount');
        $this->db->from('donation_order_item doi');
        $this->db->join('donation_order do','doi.orderid = do.id');
        $this->db->where('doi.donationid',$donationid);
        $this->db->like('do.status','成功');
        $query = $this->db->get();
        $entry = $query->row();
        $soldcount = $entry->soldcount;
		//使用查找的soldcount更新
		$this->db->where('id',$donationid);
		$this->db->set('soldcount', $soldcount, FALSE); //加FALSE避免被转义
		$this->db->update('donation');
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}
?>