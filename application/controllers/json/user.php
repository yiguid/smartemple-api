<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('json_user_mdl');
		header('content-type:application/json;charset=utf8');  
	}
}
?>