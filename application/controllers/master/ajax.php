<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'master')
		{
			redirect('login','refresh');
		}
		$this->load->model('donation_mdl');
	}
	
	public function add_donation()
	{
		extract($_REQUEST);
		$donation = $this->donation_mdl->info($donationid);
		$data = array(
               'id'      => $donation->id,
               'qty'     => $soldcount,
               'price'   => $donation->price,
               'name'    => $donation->name
            );
		$this->cart->insert($data);
		echo $donation->id;
	}

	public function remove_donation()
	{
		extract($_REQUEST);
		foreach ($this->cart->contents() as $items){
			if($items['id'] == $donationid){
				$data = array(
		               'rowid'      => $items['rowid'],
		               'qty'     => 0
		            );
				$this->cart->update($data);
			}
		}
		echo $donationid;
	}
}
?>
