<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_user_mdl');
		header('content-type:application/json;charset=utf8');  
	}

	public function donation($page = 1,$num_per_page = 10)
	{
		$id = 15;
		$user_list = $this->json_user_mdl->donation_get($id,$page,$num_per_page);	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function donation_zhongchou($page = 1,$num_per_page = 10)
	{
		$id = 11;
		$user_list = $this->json_user_mdl->donation_zhongchou_get($id,$page,$num_per_page);	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function activity($page = 1,$num_per_page = 10)
	{
		$id = 15;
		$user_list = $this->json_user_mdl->activity_get($id,$page,$num_per_page);	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";
	}

	public function volunteer($page = 1,$num_per_page = 10)
	{		
		$id = 15;	
		$user_list = $this->json_user_mdl->volunteer_get($id,$page,$num_per_page);	
		echo "{\"user\":".$this->json_unescaped_unicode(json_encode($user_list))."}";	
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