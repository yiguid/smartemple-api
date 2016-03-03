<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

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
		$this->data['title'] = '登记智慧寺院';
		$this->data['nav'] = 'register';
		$this->load->model('data_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('donation_mdl');
	}

	public function index()
	{	
		$this->form_validation->set_rules('contact','联系人','required|trim|min_length[1]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('mobile','联系电话','required|trim|min_length[6]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('name','寺院名称','required|trim|min_length[1]|max_length[200]|xss_clean');
		$this->form_validation->set_rules('englishname','寺院名称','required|trim|min_length[1]|max_length[200]|xss_clean');
		$this->form_validation->set_rules('province','所在省份','required|trim|min_length[1]|max_length[200]|xss_clean');
		$this->form_validation->set_rules('city','所在城市','required|trim|min_length[1]|max_length[200]|xss_clean');
		$this->form_validation->set_rules('master','住持','required|trim|min_length[1]|max_length[200]|xss_clean');

		if($this->form_validation->run() == FALSE){
			$this->load->view('visit/register_temple',$this->data);
		}else{
			$contact = $this->input->post('contact');
			$mobile = $this->input->post('mobile');
			$name = $this->input->post('name');
			$englishname = $this->input->post('englishname');
			$master = $this->input->post('master');
			$province = $this->input->post('province');
			$city = $this->input->post('city');
			$registertime = date("Y-m-d H:i:s");
			
			//添加注册信息
			$para = array('username'=>$contact,'mobile'=>$mobile,'temple'=>$name,'registertime'=>$registertime);
			$this->data_mdl->register($para);
			//注册寺院
			//检查寺院是否存在
			if(!$this->temple_mdl->exist($name)&&!$this->temple_mdl->exist($englishname)){
				$templeid = $this->temple_mdl->add(array('name' => $name,'englishname' => $englishname,'province' => $province,'city' => $city,'master' => $master));
				//直接跳转到注册的寺院
				//添加基础的供养物
				$this->donation_mdl->insert_default_data($templeid);
				redirect('temple/id/'.$templeid, 'refresh');
			}else{
				//已经存在的寺院
				$this->data['register_info'] = '您登记的寺院已经存在，如果信息有误可以电话联系 <span class="glyphicon glyphicon-phone-alt"></span>010-53667513。<br/>如需申请该寺院管理员账户，请等待后台审核，谢谢。';
				$this->load->view('visit/register_success',$this->data);
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */