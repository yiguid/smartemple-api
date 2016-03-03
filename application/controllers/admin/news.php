<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

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
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'admin')
		{
			redirect('login','refresh');
		}
		$this->data['nav'] = 'news';
		$this->data['nav_info'] = '管理后台';
		$this->data['sidebar'] = 'news';
		$this->data['title'] = '发布新闻 - 智慧寺院';
		$this->load->model('temple_mdl');
		$this->load->model('news_mdl');
		$temple_list = $this->temple_mdl->get();
		$this->data['templeids'] = array();
		$this->data['templeids'][0] = '智慧寺院';
		foreach ($temple_list as $temple) {
			$this->data['templeids'][$temple->id] = $temple->name; 
		}
	}

	//templeid = 0 的都是admin添加的新闻
	//templeid = -1 获取全部新闻

	public function index()
	{	
		$this->session->unset_userdata('q');
		$this->data['news_list'] = $this->news_mdl->get(1,-1);
		$this->data['cur_page'] = 1;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->news_mdl->get_page(-1);
		$this->load->view('admin/news/index', $this->data);
	}

	public function page($page)
	{
		if($page < 1)
			$page = 1;
		$this->data['news_list'] = $this->news_mdl->get($page,-1); 
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->news_mdl->get_page(-1);
		$this->load->view('admin/news/index',$this->data);
	}

	public function search($page = 1)
	{
		if($page < 1)
			$page = 1;
		$q = $this->input->post('q');
		if($q != "")
			$this->session->set_userdata('q', $q);
		else
			$q = $this->session->userdata('q');
		$this->data['news_list'] = $this->news_mdl->search($q,$page,-1);
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'search';
		$this->data['total_page'] = $this->news_mdl->search_page($q,-1);
		$this->load->view('admin/news/index',$this->data);
	}

	public function add()
	{
		$this->form_validation->set_rules('title','标题','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/news/edit',$this->data);
		}else{
			$templeid = $this->input->post('templeid');
			$config['upload_path'] = './templeimg/news';
			$config['allowed_types'] = 'jpg|png|gif';
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('userfile'))
			{
				$thumb = '';
			} 
			else
			{
				$data = $this->upload->data();
				$newname = $templeid.'-'.date("YmdHis",time()).$data['file_ext'];
				$file_path = $data['file_path'];
				$newpath = $file_path.$newname;
				rename($data['full_path'],$newpath);
				$thumb = 'templeimg/news/'.$newname;//获取上传文件的路径
			}
			$news = array(
				'username' => $this->session->userdata('username'),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'description' => substr($this->input->post('description'), 0, 90),
				'catid' => 0,
				'typeid' => $this->input->post('typeid'),  //from input
				'thumb' => $thumb,
				'inputtime' => date("Y-m-d H:i:s"),
				'updatetime' => date("Y-m-d H:i:s"),
				'templeid' => $this->input->post('templeid')
			);
			$this->news_mdl->add($news);
			redirect('admin/news');
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('title','标题','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->data['news'] = $this->news_mdl->info($id);
			$this->load->view('admin/news/edit',$this->data);
		}else{
			//编辑
			$templeid = $this->input->post('templeid');
			$config['upload_path'] = './templeimg/news';
			$config['allowed_types'] = 'jpg|png|gif';
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('userfile'))
			{
				$news = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'description' => substr($this->input->post('description'), 0, 90),
					'typeid' => $this->input->post('typeid'),
					'updatetime' => date("Y-m-d H:i:s"),
					'templeid' => $this->input->post('templeid')
				);
			} 
			else
			{
				$data = $this->upload->data();
				$newname = $templeid.'-'.date("YmdHis",time()).$data['file_ext'];
				$file_path = $data['file_path'];
				$newpath = $file_path.$newname;
				rename($data['full_path'],$newpath);
				$thumb = 'templeimg/news/'.$newname;//获取上传文件的路径
				$news = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'description' => substr($this->input->post('description'), 0, 90),
					'typeid' => $this->input->post('typeid'),
					'thumb' => $thumb,
					'updatetime' => date("Y-m-d H:i:s"),
					'templeid' => $this->input->post('templeid')
				);
			}
			
			$this->news_mdl->update($id,$news);
			redirect('admin/news');
		}
	}

	public function delete($id)
	{
		$this->news_mdl->delete($id);
		redirect('admin/news');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */