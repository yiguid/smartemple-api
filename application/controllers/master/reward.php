<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reward extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'master')
		{
			redirect('login','refresh');
		}
		$this->load->model('reward_mdl');
		$this->load->model('zhongchou_mdl');
		$this->data['nav'] = 'donation';
		$this->data['sidebar'] = 'zhongchou';
		$templeid = $this->session->userdata('templeid');
	}

	public function add($zhongchouid)
	{
		$this->form_validation->set_rules('money','捐赠资金','required|trim');
		$this->form_validation->set_rules('award','奖励','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->data['zhongchou'] = $this->zhongchou_mdl->info($zhongchouid);
			$this->data['reward_list'] = $this->reward_mdl->get($zhongchouid);
			redirect('master/zhongchou/info/'.$zhongchouid);
		}else{
			$reward = array(
				'zhongchouid' => $zhongchouid,
				'money' => $this->input->post('money'),
				'award' => $this->input->post('award'),
				'rewardtime' => $this->input->post('rewardtime')
			);
			$this->reward_mdl->add($reward);
			redirect('master/zhongchou/info/'.$zhongchouid);
		}
	}
	public function edit($zhongchouid,$id)
	{
		$this->form_validation->set_rules('money','捐赠资金','required|trim');
		$this->form_validation->set_rules('award','奖励','required|trim');
		if($this->form_validation->run() == FALSE){
			$this->data['reward'] = $this->reward_mdl->info($id);
			$this->data['zhongchouid'] = $zhongchouid;
			$this->load->view('master/zhongchou/reward_edit',$this->data);
		}else{
			//编辑
			$reward = array(
				'money' => $this->input->post('money'),
				'award' => $this->input->post('award'),
				'rewardtime' => $this->input->post('rewardtime')
			);
			$this->reward_mdl->update($id,$reward);
			redirect('master/zhongchou/info/'.$zhongchouid);
		}
	}

	public function delete($id)
	{
		$this->reward_mdl->delete($id);
		redirect('master/zhongchou/info','refresh');
	}

}