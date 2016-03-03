<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class News_mdl extends CI_Model {
	public $num_per_page = 15;
	public function __construct()
	{
		parent:: __construct();

	}

	//添加
	public function add($data)
	{
		$this->db->insert('news',$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}


	//获取
	public function get($page, $templeid)
	{
		$this->db->select('news.*,temple.name as templename');
		$this->db->from('news');
		$this->db->join('temple','temple.id=news.templeid','left');
		if($templeid != -1)
			$this->db->where('templeid', $templeid);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function json_get($templeid_arr, $page, $typeid = 0){
		$this->db->select('n.id,n.title, n.views,t.name as templename');
		$this->db->from('news n');
		$this->db->join('temple t','t.id = n.templeid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('n.templeid', $templeid);
		}
		if($typeid == -1){
			$this->db->where('n.typeid !=',1);
			$this->db->where('n.typeid !=',2);
			$this->db->where('n.typeid !=',3);
		}else if($typeid > 0)
			$this->db->where('n.typeid',$typeid);
		//typeid == 0, all news
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//获取后台推荐的新闻rec
	public function get_rec($typeid,$count)
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where('typeid', $typeid);
		$this->db->limit($count,0);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//typeid = 0, all news
	//typeid = 1,2,3, special news
	//typeid = -1, news except special news
	public function get_index($templeid_arr, $count, $typeid = 0){
		$this->db->select('n.*, t.name as templename');
		$this->db->from('news n');
		$this->db->join('temple t','t.id = n.templeid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('n.templeid', $templeid);
		}
		if($typeid == -1){
			$this->db->where('n.typeid !=',1);
			$this->db->where('n.typeid !=',2);
			$this->db->where('n.typeid !=',3);
		}else if($typeid > 0)
			$this->db->where('n.typeid',$typeid);
		//typeid == 0, all news
		$this->db->limit($count,0);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//typeid = 0, all news
	//typeid = 1,2,3, special news
	//typeid = -1, news except special news
	public function get_list_by_page($templeid_arr, $page, $typeid = 0){
		$this->db->select('n.*, t.name as templename');
		$this->db->from('news n');
		$this->db->join('temple t','t.id = n.templeid','left');
		foreach ($templeid_arr as $templeid) {
			$this->db->or_where('n.templeid', $templeid);
		}
		if($typeid == -1){
			$this->db->where('n.typeid !=',1);
			$this->db->where('n.typeid !=',2);
			$this->db->where('n.typeid !=',3);
		}else if($typeid > 0)
			$this->db->where('n.typeid',$typeid);
		//typeid == 0, all news
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$this->db->order_by('inputtime','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function search($query,$page,$templeid)
	{
		$this->db->select('news.*,temple.name as templename');
		$this->db->from('news');
		$this->db->join('temple','temple.id=news.templeid','left');
		if($templeid != -1)
			$this->db->where('templeid',$templeid);
		$this->db->like('title',$query);
		$this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
		$query = $this->db->get();
		return $query->result();
	}

	public function search_page($query,$templeid)
	{
		$this->db->select('count(1)');
		$this->db->from('news');
		if($templeid != -1)
			$this->db->where('templeid',$templeid);
		$this->db->like('title',$query);
		$count = $this->db->count_all_results();
		return ceil ( $count / $this->num_per_page);
	}

	public function get_page($templeid)
	{
		$this->db->select('count(1) as count');
		if($templeid != -1)
			$this->db->where('templeid',$templeid);
		$query = $this->db->get('news');
		return ceil ($query->row()->count / $this->num_per_page);
	}

	public function info($id)
	{
		$this->db->select('n.*, t.name as templename');
		$this->db->from('news n');
		$this->db->join('temple t','t.id = n.templeid','left');
		$this->db->where('n.id',$id);
		$query = $this->db->get('news');
		return $query->row();
	}

	//删除
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('news');
		return TRUE;
	}

	//修改
	public function update($id, $data)
	{
		$this->db->where('id',$id);
		$this->db->update('news',$data);
		return TRUE;
	}

	public function add_views($id, $views)
	{
		$this->db->where('id',$id);
		$this->db->update('news',array('views' => $views));
		return TRUE;
	}
}
?>