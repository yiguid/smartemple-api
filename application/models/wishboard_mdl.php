<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishboard_mdl extends CI_Model {
    public $num_per_page = 15;

	public function __construct()
    {
        parent:: __construct();
    }

    public function get_history($templeid, $isparent = true){
        //$this->db->insert('msg_history',array('weixin'=>'123','msg' =>'test'));
	    $this->db->select('*');
        $this->db->from('wishboard');
        if($templeid != 0)
            $this->db->where('templeid',$templeid);
        if($isparent == true)
            $this->db->where('parentid',0);
        else
            $this->db->where('parentid !=',0);
        $this->db->where('status',1);
	    $this->db->order_by('datetime','desc');
	    $this->db->limit(50);
        $query = $this->db->get();
        $his_arr = $query->result();
        //记录最后获取到的消息时间
        // $this->db->select('max(datetime) as max_wishboard_datetime');
        // $query = $this->db->get('wishboard');
        // $result = $query->row();
        // $this->session->set_userdata('max_wishboard_datetime',$result->max_wishboard_datetime);
        return $his_arr;
    }

    public function get_history_by_time($templeid, $isparent = true, $rolltime = 'all'){
        $this->db->select('*');
        $this->db->from('wishboard');
        if($templeid != 0)
            $this->db->where('templeid',$templeid);
        if($isparent == true)
            $this->db->where('parentid',0);
        else
            $this->db->where('parentid !=',0);
        $this->db->where('status',1);
        //只显示本月的month，只显示本日的day
        if($rolltime == 'month'){
            $date_str = date("Y-m");
            $this->db->where('datetime >',$date_str);
        }else if($rolltime == 'day'){
            $date_str = date("Y-m-d");
            $this->db->where('datetime >',$date_str);
        }else{
            //全部显示，不执行
            ;
        }

        $this->db->order_by('datetime','desc');
        $this->db->limit(50);
        $query = $this->db->get();
        $his_arr = $query->result();
        return $his_arr;
    }
    
    public function get_answer($templeid, $count){
        $this->db->select('w1.userid as master, w1.content as answer, w2.userid as user, w2.content as question, w2.location as location');
        $this->db->from('wishboard w1');
        $this->db->join('wishboard w2','w1.parentid=w2.id');
        $this->db->where('w1.templeid', $templeid);
        $this->db->where('w1.usertype', 'master');
        $this->db->where('w2.status',1);
        $this->db->limit($count);
        $this->db->order_by('w1.datetime','desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_recent($templeid = 0){
        $this->db->select('wishboard.*, temple.name as templename');
        $this->db->from('wishboard');
        if($templeid != 0)
            $this->db->where('templeid',$templeid);
        $this->db->join('temple','temple.id=wishboard.templeid');
        $this->db->where('wishboard.status',1);
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
        $this->db->where('w.status',1);
        $this->db->limit($count,0);
        $this->db->order_by('datetime','desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_list_by_page($templeid, $page){
        $this->db->select('w.*, t.name as templename');
        $this->db->from('wishboard w');
        $this->db->join('temple t','t.id = w.templeid');
        if($templeid != 0)
            $this->db->where('w.templeid', $templeid);
        //and where 要放在最后
        $this->db->where('w.parentid','');
        $this->db->where('w.status',1);
        $this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
        $this->db->order_by('w.datetime','desc');
        $query = $this->db->get();
        $wish = $query->result();

        //取回答
        $this->db->select('*');
        $this->db->from('wishboard');
        foreach($wish as $w){
            $this->db->or_where('parentid', $w->id);
        }
        if($templeid != 0)
            $this->db->where('templeid', $templeid);
        $query = $this->db->get();
        $answer = $query->result();

        //组合
        foreach($wish as $w){
            foreach ($answer as $a) {
                if($a->parentid == $w->id){
                    $w->answer_id = $a->id;
                    $w->answer = $a->content;
                    $w->master = $a->userid;
                    $w->answer_datetime = $a->datetime;
                }
            }
        }

        return $wish;
    }

    public function json_get($templeid_arr, $page){
        $this->db->select('w.id, w.userid, w.content, t.name as templename');
        $this->db->from('wishboard w');
        $this->db->join('temple t','t.id = w.templeid');
        foreach ($templeid_arr as $templeid) {
            $this->db->or_where('templeid', $templeid);
        }
        $this->db->where('w.status',1);
        $this->db->limit($this->num_per_page,($page - 1) * $this->num_per_page);
        $this->db->order_by('datetime','desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_realname($realname){
        $this->db->select('w.*, t.name as templename');
        $this->db->from('wishboard w');
        $this->db->join('temple t','t.id = w.templeid');
        $this->db->where('userid',$realname);
        $this->db->where('w.status',1);
        $this->db->order_by('datetime','desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_realid($realid){
        $this->db->select('w.*, t.name as templename');
        $this->db->from('wishboard w');
        $this->db->join('temple t','t.id = w.templeid');
        $this->db->where('userrealid',$realid);
        $this->db->where('w.status',1);
        $this->db->order_by('datetime','desc');
        $query = $this->db->get();
        $wish = $query->result();

        //取回答
        $this->db->select('*');
        $this->db->from('wishboard');
        foreach($wish as $w){
            $this->db->or_where('parentid', $w->id);
        }
        $query = $this->db->get();
        $answer = $query->result();

        //组合
        foreach($wish as $w){
            foreach ($answer as $a) {
                if($a->parentid == $w->id){
                    $w->answer_id = $a->id;
                    $w->answer = $a->content;
                    $w->master = $a->userid;
                    $w->answer_datetime = $a->datetime;
                }
            }
        }

        return $wish;
    }

    public function get_recent_by_page($templeid = 0,$count = 20, $page = 1){
        $this->db->select('wishboard.*, temple.name as templename');
        $this->db->from('wishboard');
        if($templeid != 0)
            $this->db->where('templeid',$templeid);
        $this->db->where('status',1);
        $this->db->join('temple','temple.id=wishboard.templeid');
        $this->db->order_by('datetime','desc');
        $this->db->limit($count,$page - 1);
        $query = $this->db->get();
        $his_arr = $query->result();
        return $his_arr;
    }

    public function add($param){
        $this->db->insert('wishboard',$param);
        return $this->db->insert_id();
    }

    //修改
    public function update($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update('wishboard',$data);
        return TRUE;
    }

    //修改
    public function update_by_donationorderid($donationorderid, $data)
    {
        $this->db->where('donationorderid',$donationorderid);
        $this->db->update('wishboard',$data);
        return TRUE;
    }

    public function update_by_recordid($recordid, $data)
    {
        $this->db->where('recordid',$recordid);
        $this->db->update('wishboard',$data);
        return TRUE;
    }

    public function info($id)
    {
        $this->db->select('*');
        $this->db->from('wishboard');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
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

    public function get_year_history(){
        $this->db->select('datetime,userid,content,donationcontent,location');
        $this->db->from('wishboard');
        $this->db->where('parentid',0);
        $this->db->where('content !=','');
        $this->db->where('status',1);
        $this->db->order_by('datetime','desc');
        $this->db->limit(50);
        $query = $this->db->get();
        $his_arr = $query->result();
        return $his_arr;
    }


    public function get_src($templeid,$days = 1)
    {
        if($days == 1){
            $date_str = date("Y-m-d");
            $query = $this->db->query('select left(location,2) as src,sum(1) as sum from wishboard where templeid = ? and datetime > ? group by src',array($templeid,$date_str));
        }else if($days == 30){
            $date_str = date("Y-m");
            $query = $this->db->query('select left(location,2) as src,sum(1) as sum from wishboard where templeid = ? and datetime > ? group by src',array($templeid,$date_str));
        }else
            $query = $this->db->query('select left(location,2) as src,sum(1) as sum from wishboard where templeid = ? group by src',array($templeid));
        return $query->result();
    }

    public function get_src_to_des($limit)
    {
        $date_str = date("Y-m-d H:i:s");
        $date_str = date('Y-m-d H:i:s',strtotime("$date_str - $limit hour"));
        // $query = $this->db->query('select left(location,2) as src,left(province,2) as des from wishboard,temple where wishboard.templeid = temple.id order by datetime desc limit ?',array($limit));
        $query = $this->db->query("select left(location,2) as src,left(province,2) as des from wishboard,temple where wishboard.templeid = temple.id and datetime > '$date_str' order by datetime desc");
        return $query->result();
    }
}
?>
