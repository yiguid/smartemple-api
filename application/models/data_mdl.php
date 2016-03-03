<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Data_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
	}

	//获取总数目
	public function get_count($dbname)
	{
		$this->db->from($dbname);
		return $this->db->count_all_results();
	}

	public function get_count_by_templeid($dbname, $templeid)
	{
		$this->db->from($dbname);
		$this->db->where('templeid',$templeid);
		return $this->db->count_all_results();
	}

	//注册登记
	public function register($para)
	{
		$this->db->insert('register',$para);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	//检测注册联系人手机号是否已经存在
	public function register_mobile_exist($mobile)
	{
		$this->db->select('*');
		$this->db->where('mobile',$mobile);
		$num = $this->db->get('register')->num_rows();
		return ($num > 0) ? TRUE : FALSE;
	}

	public function get_register()
	{
		$this->db->select('*');
		$this->db->from('register');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function time_tran($the_time){
		$now_time = date("Y-m-d H:i:s",time());
		$now_time = strtotime($now_time);
		$show_time = strtotime($the_time);
		$dur = $now_time - $show_time;
		if($dur < 0){
			return $the_time;
		}else if($dur < 60){
			return $dur.'秒前';
		}else if($dur < 3600){
				return floor($dur/60).'分钟前';
		}else if($dur < 86400){
				return floor($dur/3600).'小时前';
		}else if($dur < 259200){//3天内
			return floor($dur/86400).'天前';
		}else{
			return $the_time;
		}
	}
}
?>