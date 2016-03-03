<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Find extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_find_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function temple($page = 1,$num_per_page = 10)
	{
		$find_list = $this->json_find_mdl->temple_get($page,$num_per_page);	
		echo "{\"find\":".$this->json_unescaped_unicode(json_encode($find_list))."}";
	}

	public function master($page = 1,$num_per_page = 10)
	{
		$find_list = $this->json_find_mdl->master_get($page,$num_per_page);	
		echo "{\"find\":".$this->json_unescaped_unicode(json_encode($find_list))."}";
	}

	public function news($page = 1,$num_per_page = 10)
	{
		$find_list = $this->json_find_mdl->news_get($page,$num_per_page);	
		echo "{\"find\":".$this->json_unescaped_unicode(json_encode($find_list))."}";
	}

	public function activity($page = 1,$num_per_page = 10)
	{
		$find_list = $this->json_find_mdl->activity_get($page,$num_per_page);	
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