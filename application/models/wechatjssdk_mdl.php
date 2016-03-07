<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Wechatjssdk_mdl extends CI_Model {
	private $appId;
	private $appSecret;
	public function __construct()
	{
		parent:: __construct();
		$this->appId = "wx8c8e5ee7950f9161";
		$this->appSecret = "9bb5fc00a114a15e6061be47321b79c8";
	}

	//添加
	public function add_voice($data)
	{
		$this->db->insert('wechatvoice',$data);
		return $this->db->insert_id();
	}

	public function update_year_wishes($templeid,$data)
	{
		$this->db->select('*');
        $this->db->from('wechatvoice');
        $this->db->where('templeid',$templeid);
        $this->db->where('type',0);
        $this->db->order_by('datetime','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $entry = $query->row();
        if(isset($entry->id)){
        	$this->db->where('id',$entry->id);
			$this->db->update('wechatvoice',$data);
		}
		return TRUE;
	}

	public function update_daily_voice($templeid,$data)
	{
		$this->db->select('*');
        $this->db->from('wechatvoice');
        $this->db->where('templeid',$templeid);
        $this->db->where('type',1);
        $date_str = date("Y-m-d");
		$this->db->where('datetime >',$date_str);
        $this->db->order_by('datetime','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $entry = $query->row();
        if(isset($entry->id)){
        	$this->db->where('id',$entry->id);
			$this->db->update('wechatvoice',$data);
		}
		return TRUE;
	}

	public function get_voice()
	{
		$this->db->select('*');
		$this->db->from('wechatvoice');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_voice_by_id($id){
		$this->db->select('*');
        $this->db->from('wechatvoice');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	public function get_voice_by_templeid($templeid){
		$this->db->select('*');
        $this->db->from('wechatvoice');
        $this->db->where('templeid',$templeid);
        $this->db->where('type',0);
        $this->db->order_by('datetime','desc');
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	//type = 1
	public function get_timeline_voice_by_templeid($templeid, $daily = false){
		$this->db->select('*');
        $this->db->from('wechatvoice');
        $this->db->where('templeid',$templeid);
        $this->db->where('type',1);
        if($daily){
        	$date_str = date("Y-m-d");
			$this->db->where('datetime >',$date_str);
        }
        $this->db->order_by('datetime','desc');
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	//type = 1
	public function get_timeline_voice_by_templeid_datetime($templeid, $datetime){
		$this->db->select('*');
        $this->db->from('wechatvoice');
        $this->db->where('templeid',$templeid);
        $this->db->where('type',1);
        $this->db->where('datetime',$datetime);
        $query = $this->db->get();
        $entry = $query->row();
        return $entry;
	}

	public function get_master_voice()
	{
		$query = $this->db->query('select mv.datetime,mv.id,mv.templeid,t.name,t.province,t.city,t.name as templename,m.realname,md.avatar from (select datetime,id,templeid from wechatvoice order by datetime desc) mv, temple t,user m,master_detail md where t.id = mv.templeid and m.templeid = mv.templeid and md.masterid = m.id group by templeid order by datetime desc');
		return $query->result();
	}

	public function getSignPackage() {
		$jsapiTicket = $this->getJsApiTicket();

		// 注意 URL 一定要动态获取，不能 hardcode.
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$timestamp = time();
		$nonceStr = $this->createNonceStr();

		// 这里参数的顺序要按照 key 值 ASCII 码升序排序
		$string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

		$signature = sha1($string);

		$signPackage = array(
		  "appId"     => $this->appId,
		  "nonceStr"  => $nonceStr,
		  "timestamp" => $timestamp,
		  "url"       => $url,
		  "signature" => $signature,
		  "rawString" => $string
		);
		return $signPackage; 
	}

	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
		  $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	private function getJsApiTicket() {
		// jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
		$data = json_decode(file_get_contents("./jssdk/jsapi_ticket.json"));
		if ($data->expire_time < time()) {
		  $accessToken = $this->getAccessToken();
		  // 如果是企业号用以下 URL 获取 ticket
		  // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
		  $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
		  $res = json_decode($this->httpGet($url));
		  $ticket = $res->ticket;
		  if ($ticket) {
		    $data->expire_time = time() + 7000;
		    $data->jsapi_ticket = $ticket;
		    $fp = fopen("./jssdk/jsapi_ticket.json", "w");
		    fwrite($fp, json_encode($data));
		    fclose($fp);
		  }
		} else {
		  $ticket = $data->jsapi_ticket;
		}

		return $ticket;
	}

	private function getAccessToken() {
		// access_token 应该全局存储与更新，以下代码以写入到文件中做示例
		$data = json_decode(file_get_contents("./jssdk/access_token.json"));
		if ($data->expire_time < time()) {
		  // 如果是企业号用以下URL获取access_token
		  // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
		  $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
		  $res = json_decode($this->httpGet($url));
		  $access_token = $res->access_token;
		  if ($access_token) {
		    $data->expire_time = time() + 7000;
		    $data->access_token = $access_token;
		    $fp = fopen("./jssdk/access_token.json", "w");
		    fwrite($fp, json_encode($data));
		    fclose($fp);
		  }
		} else {
		  $access_token = $data->access_token;
		}
		return $access_token;
	}

	private function httpGet($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 500);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_URL, $url);

		$res = curl_exec($curl);
		curl_close($curl);

		return $res;
	}
}
?>