<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '智慧寺院 - 结算页面';
		$this->load->model('temple_mdl');
		$this->load->model('donation_mdl');
		$this->data['temple_nav'] = 'donation';
		// if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'user')
		// {
		// 	//跳转前纪录from
		// 	$this->session->set_userdata('jump_from','checkout');
		// 	redirect('login','refresh');
		// }
	}

	public function index()
	{	
		$templeid = $this->session->userdata('page_templeid');
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->load->view('temple/donation_checkout', $this->data);
	}

	public function success($donation_order_id)
	{
		$templeid = $this->session->userdata('page_templeid');
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['donation_order_id'] = $donation_order_id;
		$this->load->view('temple/donation_checkout_success', $this->data);
	}

	public function update($donation_order_id)
	{
		$contact = $this->session->userdata('realname');
		$mobile = $this->session->userdata('mobile');
		$username = $this->session->userdata('username');
	    $this->donation_mdl->update_order($donation_order_id, array('contact' => $contact,'mobile' => $mobile
			,'username' => $username));
	    redirect('user/order/'.$donation_order_id,'refresh');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */