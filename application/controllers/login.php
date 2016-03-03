<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->data['title'] = '登录智慧寺院';
		$this->data['nav'] = 'login';
		$this->load->model('temple_mdl');
	}

	public function index()
	{	
		$this->data['nav_info'] = '已有账户登录';
		$page_templeid = $this->session->userdata('page_templeid');
		$this->data['temple'] = $this->temple_mdl->info($page_templeid);
		$savedCart = $this->cart->contents();
		if($this->auth->logged_in())
		{
			if($this->session->userdata('usertype') == 'user'){
				if($this->session->userdata('jump_from') == null)
					redirect('user','refresh');
				else{
					redirect($this->session->userdata('jump_from'),'refresh');
				}
			}
			else if($this->session->userdata('usertype') == 'master')
				redirect('master/overview','refresh');
			else if($this->session->userdata('usertype') == 'admin')
				redirect('admin/manage','refresh');
		}else{			
			$this->form_validation->set_rules('username','用户名','required|trim');
			$this->form_validation->set_rules('password','密码','required|trim');

			if($this->form_validation->run() == FALSE){
				$this->load->view('v1_login',$this->data);
			}else if($this->auth->login($this->input->post('username'),$this->input->post('password'))){
				if($this->session->userdata('usertype') == 'master')
					redirect('master/overview','refresh');
				else if($this->session->userdata('usertype') == 'admin')
					redirect('admin/manage','refresh');
				else{
					$this->cart->insert($savedCart); 
					if($this->session->userdata('jump_from') == null)
						redirect('user','refresh');
					else{
						redirect($this->session->userdata('jump_from'),'refresh');
					}
				}
			}else{
				$this->data['login_info'] = '用户名或密码错误 | <a href="login/resetpwd">忘记密码？</a>';
				$this->load->view('v1_login',$this->data);
			}
		}
	}

	public function resetpwd()
	{
		$page_templeid = $this->session->userdata('page_templeid');
		$this->data['temple'] = $this->temple_mdl->info($page_templeid);
    	$this->data['nav_info'] = '短信验证重置密码';
		$this->load->view('v1_resetpwd', $this->data);
	}

	public function logout()
	{
		$this->auth->logout();
		redirect('index','refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */