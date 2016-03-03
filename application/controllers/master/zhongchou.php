<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class zhongchou extends CI_Controller {
	public $data = array();
	public $templeid;
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'master')
		{
			redirect('login','refresh');
		}
		$this->load->model('zhongchou_mdl');
		$this->load->model('reward_mdl');
		$this->load->model('data_mdl');
		$this->data['nav'] = 'donation';
		$this->data['sidebar'] = 'zhongchou';
		$this->templeid = $this->session->userdata('templeid');
	}
	
	public function index()
	{
		$this->data['zhongchou_list'] = $this->zhongchou_mdl->get(1,$this->templeid);
		$this->data['cur_page'] = 1;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->zhongchou_mdl->get_page($this->templeid);
		$this->load->view('master/zhongchou/index',$this->data);
	}

	public function page($page)
	{
		if($page < 1)
			$page = 1;
		$this->data['zhongchou_list'] = $this->zhongchou_mdl->get($page,$this->templeid); 
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'page';
		$this->data['total_page'] = $this->zhongchou_mdl->get_page($this->templeid);
		$this->load->view('master/zhongchou/index',$this->data);
	}


	public function search($page = 1)
	{
		if($page < 1)
			$page = 1;
		$q = $this->input->post('q');
		if($q != "")
			$this->session->set_userdata('q', $q);
		else
			$q = "";
		$this->data['zhongchou_list2'] = $this->zhongchou_mdl->search($q,$page,$this->templeid);
		$this->data['cur_page'] = $page;
		$this->data['page_name'] = 'search';
		$this->data['total_page'] = $this->zhongchou_mdl->search_page($q,$this->templeid);
		$this->load->view('master/zhongchou/index',$this->data);
	}

	public function add()
	{
		$this->data['sidebar'] = 'zhongchou_add';
		$this->form_validation->set_rules('title','标题不能为空','min_length[0]');
		$this->form_validation->set_rules('content','内容不能为空','required|trim');
		$this->form_validation->set_rules('endtime','结束时间不能为空','required|trim');
		$this->form_validation->set_rules('target','总金额不能为空','required|trim');
		if($this->form_validation->run() == FALSE){
			$this->load->view('master/zhongchou/edit',$this->data);
		}else{
			//上传图片
			$templeid = $this->session->userdata('templeid');
			$config['upload_path'] = './templeimg/zhongchou';
			$config['allowed_types'] = 'jpg|png|gif';
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('userfile'))
			{
				$img = '';
			} 
			else
			{
				$data = $this->upload->data();
				$newname = $templeid.'-'.date("YmdHis",time()).$data['file_ext'];
				$file_path = $data['file_path'];
				$newpath = $file_path.$newname;
				rename($data['full_path'],$newpath);
				$img = 'templeimg/zhongchou/'.$newname;//获取上传文件的路径
			}
			$zhongchou = array(
				'title' => $this->input->post('title'),
				'founderid' => $this->templeid,
				'content' => $this->input->post('content'),
				'description' => substr($this->input->post('description'), 0, 90),
				'img' => $img,
				'inputtime' => date("Y-m-d H:i:s"),
				'endtime' => $this->input->post('endtime'),
				'target' => $this->input->post('target')
			);
			$this->zhongchou_mdl->add($zhongchou);
			redirect('master/zhongchou');
		}
	}
	public function edit($id)
	{
		$this->form_validation->set_rules('title','标题不能为空','min_length[0]');
		$this->form_validation->set_rules('content','内容不能为空','required|trim');
		$this->form_validation->set_rules('endtime','结束时间不能为空','required|trim');
		$this->form_validation->set_rules('target','总金额不能为空','required|trim');
		if($this->form_validation->run() == FALSE){
			$this->data['zhongchou'] = $this->zhongchou_mdl->info($id);
			$this->load->view('master/zhongchou/edit',$this->data);
		}else{
			//编辑
			//上传图片
			$templeid = $this->session->userdata('templeid');
			$config['upload_path'] = './templeimg/zhongchou';
			$config['allowed_types'] = 'jpg|png|gif';
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('userfile'))
			{
				$zhongchou = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'description' => substr($this->input->post('description'), 0, 90),
					'endtime' => $this->input->post('endtime'),
					'target' => $this->input->post('target')
				);
			} 
			else
			{
				$data = $this->upload->data();
				$newname = $templeid.'-'.date("YmdHis",time()).$data['file_ext'];
				$file_path = $data['file_path'];
				$newpath = $file_path.$newname;
				rename($data['full_path'],$newpath);
				$img = 'templeimg/zhongchou/'.$newname;//获取上传文件的路径
				$zhongchou = array(
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'description' => substr($this->input->post('description'), 0, 90),
					'img' => $img,
					'endtime' => $this->input->post('endtime'),
					'target' => $this->input->post('target')
				);
			}
			
			$this->zhongchou_mdl->update($id,$zhongchou);
			redirect('master/zhongchou');
		}
	}

	public function delete($id)
	{
		$this->zhongchou_mdl->delete($id);
		redirect('master/zhongchou','refresh');
	}

	public function info($id)
	{
		$this->data['zhongchou'] = $this->zhongchou_mdl->info($id);
		$this->data['reward_list'] = $this->reward_mdl->get($id);
		$this->data['donator_list']  = $this->zhongchou_mdl->get_donator_list($id);
		$total_money = 0;
		$support_count = array();

		//初始化每个reward的捐助人数为0
		foreach ($this->data['reward_list'] as $reward) {
			$support_count[$reward->id] = 0;
		}

		//遍历已捐助的清单
		foreach ($this->data['donator_list'] as $donator) {
			//获得总支持的金额
			$total_money += $donator->money;
			//获得每个捐助项目支持的人数
			$support_count[$donator->rewardid] ++;
			//变换时间
			$donator->recordtime = $this->data_mdl->time_tran($donator->recordtime);
		}

		$this->data['support_count'] = $support_count;
		$this->data['total_money'] = $total_money;
		$this->load->view('master/zhongchou/info',$this->data);
	}

	public function donator($id)
	{
		$this->data['zhongchou'] = $this->zhongchou_mdl->info($id);
		$this->data['reward_list'] = $this->reward_mdl->get($id);
		$this->data['donator_list']  = $this->zhongchou_mdl->get_donator_list($id);
		$total_money = 0;
		$support_count = array();

		//初始化每个reward的捐助人数为0
		foreach ($this->data['reward_list'] as $reward) {
			$support_count[$reward->id] = 0;
		}

		//遍历已捐助的清单
		foreach ($this->data['donator_list'] as $donator) {
			//获得总支持的金额
			$total_money += $donator->money;
			//获得每个捐助项目支持的人数
			$support_count[$donator->rewardid] ++;
			//变换时间
			$donator->recordtime = $this->data_mdl->time_tran($donator->recordtime);
		}

		$this->data['support_count'] = $support_count;
		$this->data['total_money'] = $total_money;
		$this->load->view('master/zhongchou/donator',$this->data);
	}
}
?>