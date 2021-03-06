<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_master_mdl');
		$this->load->model('accesstoken_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function info()
	{		
		$masterid = $this->input->get('masterid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$master_list = $this->json_master_mdl->info_get($masterid);	
		}
		else
			$master_list = array('code'=>-1,'msg'=>'error');
		echo $this->json_unescaped_unicode(json_encode($master_list));
	}

	public function all()
	{		
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$master_list = $this->json_master_mdl->all_get($page,$limit);
		}
		else
			$master_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function recommend()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$master_list = $this->json_master_mdl->recommend_get($page,$limit);	
		}
		else
			$master_list = array('code'=>-1,'msg'=>'error');
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function hot()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$master_list = $this->json_master_mdl->hot_get($page,$limit);
		}
		else
			$master_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function search()
	{		 	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$master_name = $this->input->get("searchmaster");	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{	
			$master_list = $this->json_master_mdl->search_get($master_name,$page,$limit);	
		}
		else
			$master_list = array('code'=>-1,'msg'=>'error');
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function timeline()
	{				
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$masterid = $this->input->get('masterid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$master_list = $this->json_master_mdl->timeline_get($masterid,$page,$limit);	
		}
		else
			$master_list = array('code'=>-1,'msg'=>'error');
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function voice()
	{				
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$masterid = $this->input->get('masterid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$master_list = $this->json_master_mdl->voice_get($masterid,$page,$limit);	
		}
		else
			$master_list = array('code'=>-1,'msg'=>'error');
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function question()
	{				
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$masterid = $this->input->get('masterid');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$master_list = $this->json_master_mdl->question_get($masterid,$page,$limit);
		}
		else
			$master_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function views()
	{		
		$masterid = $this->input->post('masterid');
		$this->json_master_mdl->views_add($masterid);			
	}

	public function likes()
	{		
		$masterid = $this->input->post('masterid');
		$this->json_master_mdl->likes_add($masterid);			
	}

	public function liked()
	{		
		$masterid = $this->input->post('masterid');
		$this->json_master_mdl->liked_low($masterid);			
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