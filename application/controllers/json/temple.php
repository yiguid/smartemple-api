<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temple extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_temple_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function info()
	{	
		$templeid = $this->input->get('templeid');	
		$temple_list = $this->json_temple_mdl->info_get($templeid);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function all()
	{	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');		
		$temple_list = $this->json_temple_mdl->all_get($page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function attention()
	{
		$id = $this->session->userdata('id');
		$temple_list = $this->json_temple_mdl->attention_get($templeid_arr,$id,$page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function recommend()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$temple_list = $this->json_temple_mdl->recommend_get($page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function hot()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$temple_list = $this->json_temple_mdl->hot_get($page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function search()
	{		 	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$temple_name = $this->input->get("searchtemple");	
		$temple_list = $this->json_temple_mdl->search_get($temple_name,$page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function donation()
	{		 			
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');		
		$temple_list = $this->json_temple_mdl->donation_get($templeid,$page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function d_zhongchou()
	{		 				
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');		
		$temple_list = $this->json_temple_mdl->d_zhongchou_get($templeid,$page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function news()
	{		
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');	 			
		$temple_list = $this->json_temple_mdl->news_get($templeid,$page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function activity()
	{		 	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');				
		$temple_list = $this->json_temple_mdl->activity_get($templeid,$page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function volunteer()
	{		 		
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');			
		$temple_list = $this->json_temple_mdl->volunteer_get($templeid,$page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function wish()
	{		 	
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$templeid = $this->input->get('templeid');				
		$temple_list = $this->json_temple_mdl->wish_get($templeid,$page,$limit);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function views()
	{		 							
	}

	public function message()
	{		 	
		$data = array(
					'parentid' => '0',
					'userid' => $this->input->post('realname'),
					'usertype' => 'user',
					'content' => $this->input->post('content'),
					'donationcontent' => null,
					'datetime' => date("Y-m-d H:i:s",strtotime('now +8 hours')),
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