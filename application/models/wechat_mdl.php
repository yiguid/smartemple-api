<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once('simple_html_dom.php'); 

//define your token
define("TOKEN", "smartemple");

class Wechat_mdl extends CI_Model {

	public function __construct()
    {
        parent:: __construct();
    }

    public function get_history(){
        //$this->db->insert('msg_history',array('weixin'=>'123','msg' =>'test'));
	    $this->db->select('username,msg,datetime');
        $this->db->from('msg_history');
        $this->db->join('weixin_user','weixin_user.weixin=msg_history.weixin');
	    $this->db->order_by('datetime','desc');
	    $this->db->limit(20);
        $query = $this->db->get();
        $his_arr = $query->result();
        //记录最后获取到的消息时间
        $this->db->select('max(datetime) as max_chathistory_datetime');
        $query = $this->db->get('msg_history');
        $result = $query->row();
        $this->session->set_userdata('max_chathistory_datetime',$result->max_chathistory_datetime);
        return $his_arr;
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

    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
		
	public function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

    public function saveChatHistory($fromUsername,$keyword)
    {
        $chat_history_arr = array('weixin' => $fromUsername, 'msg' => $keyword, 'datetime' => date("Y-m-d H:i:s"));
        $this->db->insert('msg_history',$chat_history_arr);
    }

    public function getTeachModelResponse($keyword)
    {
        $info = explode(' ',$keyword);
        if(count($info) != 3)
            return "参数数量不对，请重新输入\ncode msg reply";
        else{
            $ai_arr = array('msg' => $info[1], 'reply' => $info[2]);
            $this->db->insert('ai',$ai_arr);
            return "已学习，输入 ".$info[1]." 试试吧~";
        }
    }

    public function getLatestLearned()
    {
        $this->db->select('*');
        $this->db->from('ai');
        $this->db->order_by('id','desc');
        $this->db->limit(10);
        $query = $this->db->get();
        $data = $query->result();
        $res = "";
        foreach ($data as $dat){
            $res .= $dat->msg."\n";
        }
        return $res;
    }

    public function getAIResponse($keyword)
    {
        $this->db->select('*');
        $this->db->from('ai');
        $this->db->like('msg',$keyword);
        $query = $this->db->get();
        $data = $query->result();
        if($query->num_rows() != 0){
            return $data[rand(0,count($data) - 1)]->reply;
        }
        else
            return "";
    }

    public function hasUsername($fromUsername)
    {
        $this->db->select('*');
        $this->db->from('weixin_user');
        $this->db->where('weixin',$fromUsername);
        $query = $this->db->get();
        if($query->num_rows() != 0)
            return true;
        else
            return false;
    }

    public function addUser($fromUsername,$keyword)
    {
        $info = explode(' ',$keyword);
        if(count($info) != 3)
            return "参数数量不对，请重新输入\nm 微信号 昵称";
        else{
            $user_arr = array('weixin' => $fromUsername,'weixinhao' =>$info[1], 'username' => $info[2]);
            $this->db->insert('weixin_user',$user_arr);
            return "已保存你的用户信息，输入：q 消息，上公众墙吧~";
        }
    }

    public function parseXML($postStr)
    {
        return simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    }

    public function packageXML($fromUsername, $toUsername, $time, $msgType, $contentStr)
    {
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>0</FuncFlag>
            </xml>";
        return sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
    }
}

?>
