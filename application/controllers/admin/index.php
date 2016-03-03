<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

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
		$this->data['title'] = '智慧寺院 - 管理员登录';
		$this->data['nav'] = 'index';
		$this->load->model('temple_mdl');
		$this->load->model('donation_mdl');
	}

	public function index()
	{	
		$this->data['nav_info'] = '法师登录';
		if($this->auth->logged_in())
		{
			if($this->session->userdata('usertype') == 'user'){
				if($this->session->userdata('jump_from') == null)
					redirect('temple/id/'.$page_templeid,'refresh');
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
				$this->load->view('admin/v1_login',$this->data);
			}else if($this->auth->login($this->input->post('username'),$this->input->post('password'))){
				if($this->session->userdata('usertype') == 'master')
					redirect('master/overview','refresh');
				else if($this->session->userdata('usertype') == 'admin')									
					redirect('admin/manage','refresh');				
				else{
					if($this->session->userdata('jump_from') == null)
						redirect('temple/id/'.$page_templeid,'refresh');
					else{
						redirect($this->session->userdata('jump_from'),'refresh');
					}
				}
			}else{
				$this->data['login_info'] = '用户名或密码错误 | <a href="login/resetpwd">忘记密码？</a>';
				$this->load->view('admin/v1_login',$this->data);
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */