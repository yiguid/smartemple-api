<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donation extends CI_Controller {

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
		$this->data['title'] = '智慧寺院 - 智慧供养';
		$this->data['nav'] = 'donation';
		$this->load->model('donation_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('cart_mdl');
		$this->load->model('qrcode_mdl');
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
		$this->data['donation'] = $this->donation_mdl->get($templeid);
		$this->load->view('temple/donation_list',$this->data);
	}

	public function temple($templeid)
	{
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'user')
		{
			redirect('login','refresh');
		}
		//从页面直接访问，先设置templeid到session
		//必须不能是master用户，要不然管理就混乱了
        if($this->session->userdata('usertype') != 'master'){
			$this->session->set_userdata('page_templeid',$templeid);
		}
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['donation'] = $this->donation_mdl->get($templeid);
		$this->load->view('temple/donation_list',$this->data);
	}

	public function item($templeid,$donationid)
	{
		//$templeid = $this->session->userdata('templeid');
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		//这里需要再测试，当page templeid没有设置的时候才需要设置，比如别人发过来的
		if($this->session->userdata('page_templeid') == null && $this->session->userdata('templeid') == null)
			$this->session->set_userdata('page_templeid',$templeid);
		$this->data['donation'] = $this->donation_mdl->get_by_id_and_templeid($donationid,$templeid);
		$this->data['donation_qrcode'] = $this->qrcode_mdl->get_donation_qrcode($templeid,$donationid);
		$this->data['donation_contact_list'] = $this->donation_mdl->get_donation_contact_list($donationid);
		//如果有这个item
		if($this->data['donation'] != null){
			$this->data['title'] = $this->data['donation']->name .' - '. $this->data['temple']->name.' - 智慧供养';
			$this->load->view('temple/donation_item',$this->data);
		}
		else
			redirect(base_url()."temple/id/".$templeid,'refresh');
	}

	public function submit()
	{
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'user')
		{
			redirect('login','refresh');
		}
		foreach ($this->input->post() as $key => $soldcount) {
			//过滤name中的soldcount，获取id值
			//echo str_replace('soldcount','',$key) . " | ".$value;
			if($soldcount != 0){
				$donationid = str_replace('soldcount','',$key);
				$donation = $this->donation_mdl->info($donationid);
				$data = array(
		               'id'      => $donation->id,
		               'qty'     => $soldcount,
		               'price'   => $donation->price,
		               'name'    => $donation->name
		            );
				$this->cart->insert($data);
			}
		}
		//var_dump($this->cart->contents());
		if($this->cart->total_items() > 0){
			/* 应该是确认支付的时候生成订单数据
			//生成订单
			$contact = $this->session->userdata('realname');
			$mobile = $this->session->userdata('username');
			$username = $this->session->userdata('username');
			$status = '未支付';
			$ordertime = date("Y-m-d H:i:s");
			//订单号编号规则
			$id = "D".date("YmdHis").substr(md5($ordertime),0,6);
			$templeid = $this->session->userdata('templeid');
			$result = $this->donation_mdl->add_order(array('id'=>$id,'contact' => $contact,'mobile' => $mobile
				,'username' => $username,'total' => $this->cart->total(),'status' => $status,'ordertime' => $ordertime
				,'templeid' => $templeid));
			if($result)
				$this->session->set_userdata('donation_order_id',$id);
			//生成order_item
			foreach ($this->cart->contents() as $item) {
				$oi = array('orderid' => $id,'donationid' => $item['id'],'count' => $item['qty']);
				$this->donation_mdl->add_order_item($oi);
			}
			*/
			redirect('donation/order','refresh');
		}
		else
			redirect('donation','refresh');
	}

	public function order()
	{
		if($this->session->userdata('page_templeid') != null)
			$templeid = $this->session->userdata('page_templeid');
		else if($this->session->userdata('templeid'))
			$templeid = $this->session->userdata('templeid');
		else
			redirect('visit','refresh');
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['title'] = $this->data['temple']->name.' - 智慧供养结算';
		$this->load->view('temple/donation_order',$this->data);
	}

	public function destroy()
	{
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'user')
		{
			redirect('login','refresh');
		}
		$this->cart_mdl->destroy();
		redirect('temple','refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */