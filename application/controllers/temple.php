<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temple extends CI_Controller {

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
		$this->data['title'] = '智慧寺院';
		$this->data['nav'] = 'index';
		$this->load->model('donation_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('cart_mdl');
		$this->load->model('wishboard_mdl');
		$this->load->model('news_mdl');
		$this->load->model('activity_mdl');
		$this->data['temple_nav'] = 'donation';
	}

	public function index()
	{	
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'user')
		{
			redirect('login','refresh');
		}
		$templeid = $this->session->userdata('templeid');
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		//$this->data['shidagongyang'] = $this->donation_mdl->get_by_type($templeid,'十大供养');
		//$this->data['gongyangfo'] = $this->donation_mdl->get_by_type($templeid,'供养佛');
		//$this->data['gongyangfa'] = $this->donation_mdl->get_by_type($templeid,'供养法');
		//$this->data['aidegongyang'] = $this->donation_mdl->get_by_type($templeid,'爱的供养');
		$this->data['foxiang'] = $this->donation_mdl->get_by_type($templeid,'佛像');
		$this->data['jiancai'] = $this->donation_mdl->get_by_type($templeid,'建材');
		$this->data['shebei'] = $this->donation_mdl->get_by_type($templeid,'设备');
		$this->data['huamu'] = $this->donation_mdl->get_by_type($templeid,'花木');
		$this->data['wish'] = $this->wishboard_mdl->get_history($templeid);
		$this->load->view('temple/index', $this->data);
	}

	public function shida($templeid = null)
	{
		if($templeid == null)
			redirect('visit','refresh');
		//从页面直接访问，先设置templeid到session,要同时修改两个session
		//必须不能是master用户，要不然管理就混乱了
		if($this->session->userdata('usertype') != 'master'){
			$this->session->set_userdata('page_templeid',$templeid);
			$this->session->set_userdata('templeid',$templeid);
		}
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['shidagongyang'] = $this->donation_mdl->get_by_type($templeid,'十大供养');
		$this->data['title'] = $this->data['temple']->name.' - 十大供养';
		$this->data['wish'] = $this->wishboard_mdl->get_history($templeid);
		$this->load->view('temple/shida', $this->data);
	}
	
	public function id($templeid = null)
	{
		if($templeid == null)
			redirect('visit','refresh');
		//从页面直接访问，先设置templeid到session,要同时修改两个session
		//必须不能是master用户，要不然管理就混乱了
		if($this->session->userdata('usertype') != 'master'){
			$this->session->set_userdata('page_templeid',$templeid);
			$this->session->set_userdata('templeid',$templeid);
		}
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['foxiang'] = $this->donation_mdl->get_by_type($templeid,'佛像');
		$this->data['jiancai'] = $this->donation_mdl->get_by_type($templeid,'建材');
		$this->data['shebei'] = $this->donation_mdl->get_by_type($templeid,'设备');
		$this->data['huamu'] = $this->donation_mdl->get_by_type($templeid,'花木');
		$this->data['title'] = $this->data['temple']->name.' - 智慧供养';
		$this->data['temple_notice'] = '测试通知公告';
		$this->data['wish'] = $this->wishboard_mdl->get_history($templeid);
		$this->load->view('temple/index', $this->data);
	}

	public function home($templeid = null)
	{
		$this->data['temple_nav'] = 'home';
		if($templeid == null)
			redirect('visit','refresh');
		//从页面直接访问，先设置templeid到session,要同时修改两个session
		//必须不能是master用户，要不然管理就混乱了
		if($this->session->userdata('usertype') != 'master'){
			$this->session->set_userdata('page_templeid',$templeid);
			$this->session->set_userdata('templeid',$templeid);
		}
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['title'] = $this->data['temple']->name . '主页';
		$this->data['temple_notice'] = '测试通知公告';
		//typeid = 0, all news
		//typeid = 1,2,3, special news
		//typeid = -1, news except special news
		$this->data['news_list'] = $this->news_mdl->get_index(array($templeid), 1, -1);
		$this->data['news1_list'] = $this->news_mdl->get_index(array($templeid), 1, 0);
		$this->data['activity_list'] = $this->activity_mdl->get_index(array($templeid), 2);
		$this->data['qf_list'] = $this->wishboard_mdl->get_index(array($templeid), 10);
		$this->data['roll_list'] = $this->donation_mdl->get_recent_roll(array($templeid),1,TRUE);

		$this->load->view('temple/home', $this->data);
	}

	public function ajax_cart_add()
	{
		extract($_REQUEST);
		$donation = $this->donation_mdl->info($donationid);
		$item = $this->cart_mdl->exist($donationid);
		if(empty($item)){
			$data = array(
	               'id'      => $donation->id,
	               'qty'     => 1,
	               'price'   => $donation->price,
	               'name'    => $donation->name
	            );
			$this->cart->insert($data);
		}else{
			$data = array(
               		'rowid'	=> $item['rowid'],
               		'qty'	=> $item['qty'] + 1
           		);
			$this->cart_mdl->update($data);
		}
		echo "{'total_items':'".$this->cart->total_items()."','total':'".$this->cart->total()."'}";
	}

	public function ajax_cart_sub()
	{
		extract($_REQUEST);
		$donation = $this->donation_mdl->info($donationid);
		$item = $this->cart_mdl->exist($donationid);
		$data = array(
           		'rowid'	=> $item['rowid'],
           		'qty'	=> $item['qty'] - 1
       		);
		$this->cart_mdl->update($data);
		echo "{'total_items':'".$this->cart->total_items()."','total':'".$this->cart->total()."'}";
	}

	public function ajax_cart_remove()
	{
		extract($_REQUEST);
		$this->cart_mdl->remove($donationid);
		echo "{'total_items':'".$this->cart->total_items()."','total':'".$this->cart->total()."'}";
		//echo $this->cart_mdl->remove($donationid);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */