<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temple extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_temple_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function all2($page = 1,$num_per_page = 10)
	{	
		$temple_list = $this->json_temple_mdl->all_get($page,$num_per_page);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function attention($page = 1,$num_per_page = 10)
	{
		$id = $this->session->userdata('id');
		$temple_list = $this->json_temple_mdl->attention_get($templeid_arr,$id,$page,$num_per_page);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function recommend($page = 1,$num_per_page = 10)
	{
		$temple_list = $this->json_temple_mdl->recommend_get($page,$num_per_page);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function hot($page = 1,$num_per_page = 10)
	{
		$temple_list = $this->json_temple_mdl->hot_get($page,$num_per_page);	
		echo "{\"temple\":".$this->json_unescaped_unicode(json_encode($temple_list))."}";
	}

	public function search($page = 1,$num_per_page = 10)
	{		 	
		$temple_name = $this->input->post('temple_name');
		$temple_list = $this->json_temple_mdl->search_get($temple_name,$page,$num_per_page);	
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