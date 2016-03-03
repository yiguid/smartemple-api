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
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'master')
		{
			redirect('login','refresh');
		}
		$this->load->model('temple_mdl');
		$this->data['nav'] = 'setting';
		$this->data['temple'] = $this->temple_mdl->info($this->session->userdata('templeid'));
		$this->data['nav_info'] = $this->data['temple']->name;
		$this->data['sidebar'] = 'temple';
		$this->data['title'] = '我的寺院 - 智慧寺院';
	}

	public function index()
	{	
		$this->data['sidebar'] = 'temple';
		$this->load->view('master/setting/temple', $this->data);
	}

	public function update_notice()
	{
		$templeid = $this->session->userdata('templeid');
		$data = array('website'=>$this->input->post('notice'));
		$this->temple_mdl->update($templeid, $data);
		redirect('master/temple','refresh');
	}

	public function update_homeimg()
	{
		$templeid = $this->session->userdata('templeid');
		//上传图片
		$config['upload_path'] = './templeimg/home';
		$config['allowed_types'] = 'jpg|png|gif';
		$this->load->library('upload',$config);
		if($this->upload->do_upload('userfile'))
		{
			$data = $this->upload->data();
			$newname = $templeid.'-'.date("YmdHis",time()).$data['file_ext'];
			$file_path = $data['file_path'];
			$newpath = $file_path.$newname;
			rename($data['full_path'],$newpath);
			$img = 'templeimg/home/'.$newname;//获取上传文件的路径
			$data = array('homeimg'=>$img);
			$this->temple_mdl->update($templeid, $data);
		}
		redirect('master/temple','refresh');
	}

	public function update_contacts()
	{
		$templeid = $this->session->userdata('templeid');
		$data = array('contacts'=>$this->input->post('contacts'));
		$this->temple_mdl->update($templeid, $data);
		redirect('master/temple','refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */