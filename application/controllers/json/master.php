<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_master_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function all($page = 1,$num_per_page = 10)
	{	
		$master_list = $this->json_master_mdl->all_get($page,$num_per_page);	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function recommend($page = 1,$num_per_page = 10)
	{
		$master_list = $this->json_master_mdl->recommend_get($page,$num_per_page);	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function hot($page = 1,$num_per_page = 10)
	{
		$master_list = $this->json_master_mdl->hot_get($page,$num_per_page);	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function search($page = 1,$num_per_page = 10)
	{		 	
		$master_name = $this->input->post("searchmaster");		
		$master_list = $this->json_master_mdl->search_get($master_name,$page,$num_per_page);	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function timeline($id,$page = 1,$num_per_page = 10)
	{		
		$master_list = $this->json_master_mdl->timeline_get($id,$page,$num_per_page);	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function voice($id,$page = 1,$num_per_page = 10)
	{		
		$master_list = $this->json_master_mdl->voice_get($id,$page,$num_per_page);	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function question($id,$page = 1,$num_per_page = 10)
	{		
		$master_list = $this->json_master_mdl->question_get($id,$page,$num_per_page);	
		echo "{\"master\":".$this->json_unescaped_unicode(json_encode($master_list))."}";
	}

	public function views($id)
	{		
		$this->json_master_mdl->views_get($id);			
	}

	public function likes($id)
	{		
		$this->json_master_mdl->likes_get($id);			
	}

	public function liked($id)
	{		
		$this->json_master_mdl->liked_get($id);			
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