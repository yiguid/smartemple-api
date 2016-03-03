<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller {
    public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = '禅修';
        $this->load->model('temple_mdl');
        $this->load->model('activity_mdl');
        $this->data['temple_nav'] = 'activity';
        $this->data['title'] = '禅修';
	}

	public function index()
	{
        $templeid = $this->session->userdata('templeid');
        if($templeid != null && $templeid != "")
            redirect('activity/temple/'.$templeid,'refresh');
        else
            redirect('index','refresh');
	}

    //activity list
    public function temple($templeid)
    {
        //从页面直接访问，先设置templeid到session
        //必须不能是master用户，要不然管理就混乱了
        if($this->session->userdata('usertype') != 'master'){
            $this->session->set_userdata('page_templeid',$templeid);
            $this->session->set_userdata('templeid',$templeid);
        }
        $this->data['activity_list'] = $this->activity_mdl->get(1,$templeid);
        $this->data['temple'] = $this->temple_mdl->info($templeid);
        $this->data['title'] = '禅修活动';
        $this->data['crumb'] = array(
            array('name'=> $this->data['temple']->name,'url'=>"activity/temple/".$this->data['temple']->id,'active'=>''),
            array('name'=> '禅修活动','url'=>'','active'=>'active')
            );
        $this->load->view('temple/activity/list',$this->data);
    }

    //activity single
    public function id($templeid,$id){
         if($this->session->userdata('usertype') != 'master'){
            $this->session->set_userdata('page_templeid',$templeid);
            $this->session->set_userdata('templeid',$templeid);
        }
        $this->data['activity'] = $this->activity_mdl->info($id);
        $this->data['temple'] = $this->temple_mdl->info($templeid);
        $this->data['title'] = '禅修活动';
        $this->data['crumb'] = array(
            array('name'=> $this->data['temple']->name,'url'=>"activity/temple/".$this->data['temple']->id,'active'=>''),
            array('name'=> '禅修活动','url'=>"activity/temple/".$this->data['temple']->id,'active'=>''),
            array('name'=> '内容','url'=>'','active'=>'active')
            );
        $this->data['register_list'] = $this->activity_mdl->get_register($id);
        $this->data['is_register'] = $this->activity_mdl->is_register($this->session->userdata('id'),$id);
        $this->session->set_userdata('jump_from','activity/id/'.$templeid.'/'.$id);
        $this->load->view('temple/activity/info',$this->data);
    }
}
