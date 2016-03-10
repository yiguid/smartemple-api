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

	public function new_views()
	{		 
		$id = $this->input->post('id');			
		$access_token = $this->input->post("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{			
			$this->json_find_mdl->new_views_add($id);
		}
		else
		{
			$temple_list = array('code'=>-1,'msg'=>'error');	
			echo $this->json_unescaped_unicode(json_encode($temple_list));	
		}			
	}

	public function new_detail()
	{		 
		$id = $this->input->get('id');			
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{			
			$temple_list = $this->json_find_mdl->new_detail_get($id);
		}
		else		
			$temple_list = array('code'=>-1,'msg'=>'error');	
		echo $this->json_unescaped_unicode(json_encode($temple_list));					
	}

	public function ac_detail()
	{		 
		$id = $this->input->get('id');	
		$type = $this->input->get('type');		
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{			
			$temple_list = $this->json_find_mdl->ac_detail_get($id,$type);
		}
		else		
			$temple_list = array('code'=>-1,'msg'=>'error');	
		echo $this->json_unescaped_unicode(json_encode($temple_list));					
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

	public function ac_views()
	{		 
		$id = $this->input->post('id');
		$type = $this->input->post('type');			
		$access_token = $this->input->post("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{			
			$this->json_find_mdl->ac_views_add($id,$type);
		}
		else
		{
			$temple_list = array('code'=>-1,'msg'=>'error');	
			echo $this->json_unescaped_unicode(json_encode($temple_list));	
		}			
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