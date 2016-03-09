<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_mdl');
		$this->load->model('accesstoken_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function index()
	{	
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		if($this->user_mdl->login($username,$password)){
			$user = $this->user_mdl->info_username($username);
			$date_str = date("Y-m-d");
			$date_str = date('Y-m-d',strtotime("$date_str + 7 day"));
			if($this->accesstoken_mdl->exist($user->id)){
				$res = $this->accesstoken_mdl->info($user->id);
				$access_token = $res->token;
				$this->accesstoken_mdl->update($user->id,array('expiretime'=>$date_str));
			}
			else{
				$access_token = sha1(md5($username.microtime()));
				$this->accesstoken_mdl->add(array('userid'=>$user->id,'token'=>$access_token,'expiretime'=>$date_str));
			}
			$user->access_token = $access_token;
		}
		else
			$user = array();
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user))."}";
	}

	public function validate()
	{
		$access_token = $this->input->post("access_token");
		if($this->accesstoken_mdl->validate($access_token))
			$res = array('code'=>0,'msg'=>'success','access_token' => $access_token);
		else
			$res = array('code'=>-1,'msg'=>'error');
		echo "{\"access_token\":".$this->json_unescaped_unicode(json_encode($res))."}";
	}


	private function json_unescaped_unicode($str)
	{
		return preg_replace_callback(
	            "#\\\u([0-9a-f]{4})#i",
	            function($matchs)
	            {
	                 return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
	            },
	             $str
	            );
	}

}
?>