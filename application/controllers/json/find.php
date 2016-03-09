<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Find extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_find_mdl');
		$this->load->model('accesstoken_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function temple()
	{		
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$find_list = $this->json_find_mdl->temple_get($page,$limit);			
		}
		else
			$find_list = array('code'=>-1,'msg'=>'error');
		echo "{\"find\":".$this->json_unescaped_unicode(json_encode($find_list))."}";
	}

	public function master()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$find_list = $this->json_find_mdl->master_get($page,$limit);
		}
		else
			$find_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"find\":".$this->json_unescaped_unicode(json_encode($find_list))."}";
	}

	public function news()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$find_list = $this->json_find_mdl->news_get($page,$limit);	
		}
		else
			$find_list = array('code'=>-1,'msg'=>'error');
		echo "{\"find\":".$this->json_unescaped_unicode(json_encode($find_list))."}";
	}

	public function activity()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$find_list = $this->json_find_mdl->activity_get($page,$limit);
		}
		else
			$find_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"find\":".$this->json_unescaped_unicode(json_encode($find_list))."}";
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