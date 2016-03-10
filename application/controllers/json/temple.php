<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temple extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_temple_mdl');
		$this->load->model('accesstoken_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function info()
	{	
		$templeid = $this->input->get('templeid');	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$temple_list = $this->json_temple_mdl->info_get($templeid);	
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function all()
	{	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{	
			$temple_list = $this->json_temple_mdl->all_get($page,$limit);	
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function attention()
	{		
	}

	public function recommend()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$temple_list = $this->json_temple_mdl->recommend_get($page,$limit);	
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function hot()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$temple_list = $this->json_temple_mdl->hot_get($page,$limit);
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function search()
	{		 	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$temple_name = $this->input->get("searchtemple");	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{
			$temple_list = $this->json_temple_mdl->search_get($temple_name,$page,$limit);
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');		
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function donation()
	{		 			
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{	
			$temple_list = $this->json_temple_mdl->donation_get($templeid,$page,$limit);	
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function d_zhongchou()
	{		 				
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{	
			$temple_list = $this->json_temple_mdl->d_zhongchou_get($templeid,$page,$limit);	
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function news()
	{		
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{ 			
			$temple_list = $this->json_temple_mdl->news_get($templeid,$page,$limit);	
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function activity()
	{		 	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{			
			$activity = $this->json_temple_mdl->activity_get($templeid,$page,$limit);
			$volunteer = $this->json_temple_mdl->volunteer_get($templeid,$page,$limit);
			$i = 0;$j = 0;$s = 0;
			while($i < count($activity) && $j < count($volunteer))
			{
				if($activity[$i]->activityinputtime >= $volunteer[$j]->volunteerinputtime)
				{														
					$obj = $activity[$i];
					$obj->type = 'activity';	
					$temple_list[$s] = $obj;							
					$s++;$i++;
				}
				else
				{
					$obj = $volunteer[$j];
					$obj->type = 'volunteer';
					$temple_list[$s] = $obj;					
					$s++;$j++;
				}
			}			
			while($s != count($activity)+count($volunteer))
			{
				if($i < count($activity))
				{
					$obj = $activity[$i];
					$obj->type = 'activity';	
					$temple_list[$s] = $obj;							
					$s++;$i++;
				}
				else
				{
					$obj = $volunteer[$j];
					$obj->type = 'volunteer';
					$temple_list[$s] = $obj;					
					$s++;$j++;
				}
			}						
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');	
		echo $this->json_unescaped_unicode(json_encode($temple_list)); 
	}

	public function wish()
	{		 	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{				
			$temple_list = $this->json_temple_mdl->wish_get($templeid,$page,$limit);	
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function views()
	{		 							
	}

	public function message()
	{		 	
		$access_token = $this->input->post("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{	
			$data = array(
					'parentid' => '0',
					'userid' => $this->input->post('realname'),
					'usertype' => 'user',
					'content' => $this->input->post('content'),
					'donationcontent' => null,
					'datetime' => date("Y-m-d H:i:s"),
					'templeid' => $this->input->post('templeid'),
					'location' => $this->input->post('location'),
					'recordid' => null,
					'donationorderid' => null,
					'fromurl' => $this->input->post('fromurl'),
					'ip' => $this->input->post('ip'),
					'userrealid' => $this->input->post('userid'),
					'status' => '1'
				);			
		if($this->json_temple_mdl->message_insert($data))
		{
			echo 1;return ;
		}			
		else
		{
			echo 0;return ;
		}
		}
		else
		{
			$temple_list = array('code'=>-1,'msg'=>'error');
			echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";	
		}
		
	}

	public function income_count()
	{	
		$rolltime = $this->input->get('rolltime');
		$templeid = $this->input->get('templeid');	
		$access_token = $this->input->get("access_token");
		if($this->accesstoken_mdl->validate($access_token))
		{	
			$temple_list = $this->json_temple_mdl->get_income_count($templeid, $rolltime);	 	
		}
		else
			$temple_list = array('code'=>-1,'msg'=>'error');	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";				
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