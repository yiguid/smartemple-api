<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishboard_mdl extends CI_Model {
    public $num_per_page = 2;

	public function __construct()
    {
        parent:: __construct();
    }

    public function get_history($templeid, $isparent = true){
        //$this->db->insert('msg_history',array('weixin'=>'123','msg' =>'test'));
	    $this->db->select('*');
        $this->db->from('wishboard');
        $this->db->where('templeid',$templeid);
        if($isparent == true)
            $this->db->where('parentid',0);
        else
            $this->db->where('parentid !=',0);
	    $this->db->order_by('datetime','desc');
	    $this->db->limit(100);
        $query = $this->db->get();
        $his_arr = $query->result();
        //记录最后获取到的消息时间
        $this->db->select('max(datetime) as max_wishboard_datetime');
        $query = $this->db->get('wishboard');
        $result = $query->row();
        $this->session->set_userdata('max_wishboard_datetime',$result->max_wishboard_datetime);
        return $his_arr;
    }

    public function get_recent($templeid = 0){
        $this->db->select('wishboard.*, temple.name as templename');
        $this->db->from('wishboard');
        if($templeid != 0)
            $this->db->where('templeid',$templeid);
        $this->db->join('temple','temple.id=wishboard.templeid');
        $this->db->order_by('datetime','desc');
        $this->db->limit(100);
        $query = $this->db->get();
        $his_arr = $query->result();
        return $his_arr;
    }

    public function get_index($templeid_arr, $count){
        $this->db->select('w.*, t.name as templename');
        $this->db->from('wishboard w');
        $this->db->join('temple t','t.id = w.templeid');
        foreach ($templeid_arr as $templeid) {
            $this->db->or_where('templeid', $templeid);
        }
        $this->db->limit($count,0);
        $this->db->order_by('datetime','desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_list_by_page($templeid_arr, $page){
        $this->db->select('w.*, t.name as templename');
        $this->db->from('wishboard w');
        $this->db->join('temple t','t.id = w.templeid');
        foreach ($templeid_arr as $templeid) {
            $this->db->or_where('templeid', $templeid);
        }
        $this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
        $this->db->order_by('datetime','desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_recent_by_page($templeid = 0,$count = 20, $page = 1){
        $this->db->select('wishboard.*, temple.name as templename');
        $this->db->from('wishboard');
        if($templeid != 0)
            $this->db->where('templeid',$templeid);
        $this->db->join('temple','temple.id=wishboard.templeid');
        $this->db->order_by('datetime','desc');
        $this->db->limit($count,$page - 1);
        $query = $this->db->get();
        $his_arr = $query->result();
        return $his_arr;
    }

    public function add($param){
        $this->db->insert('wishboard',$param);
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('wishboard');
    }

    public function getNewChathistory($lastChathistoryDatetime){
        /*
        <div class="label label-info"><?php echo $his->username?></div>
        <div class="alert alert-info"><?php echo $his->msg ." ( ".$his->datetime." )" ?></div>
        */
        $this->db->select('username,msg,datetime');
        $this->db->from('msg_history');
        $this->db->join('weixin_user','weixin_user.weixin=msg_history.weixin');
        $this->db->where('datetime >',$lastChathistoryDatetime);
        $query = $this->db->get();
        $his_arr = $query->result();
        $prepend_str = "";
        foreach ($his_arr as $his) {
            $prepend_str .= "<div id=\"new-chathistory\" class=\"label label-info wall-username\">".$his->username."</div><div id=\"new-chathistory\" class=\"alert alert-info\">".$his->msg."( ".$his->datetime." )</div>";
        }
        //记录最后获取到的消息时间
        $this->db->select('max(datetime) as max_chathistory_datetime');
        $query = $this->db->get('msg_history');
        $result = $query->row();
        $this->session->set_userdata('max_chathistory_datetime',$result->max_chathistory_datetime);
        return $prepend_str;
    }
}

?>
