<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Volunteer extends CI_Controller {
    public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = '义工';
        $this->load->model('temple_mdl');
        $this->load->model('volunteer_mdl');
        $this->load->model('question_mdl');
        $this->data['temple_nav'] = 'volunteer';
        $this->data['title'] = '义工';
	}

	public function index()
	{
        $templeid = $this->session->userdata('templeid');
        if($templeid != null && $templeid != "")
            redirect('volunteer/temple/'.$templeid,'refresh');
        else
            redirect('index','refresh');
	}

    //volunteer list
    public function temple($templeid)
    {
        //从页面直接访问，先设置templeid到session
        //必须不能是master用户，要不然管理就混乱了
        if($this->session->userdata('usertype') != 'master'){
            $this->session->set_userdata('page_templeid',$templeid);
            $this->session->set_userdata('templeid',$templeid);
        }
        $this->data['volunteer_list'] = $this->volunteer_mdl->get(1,$templeid);
        $this->data['temple'] = $this->temple_mdl->info($templeid);
        $this->data['title'] = '义工活动';
        $this->data['crumb'] = array(
            array('name'=> $this->data['temple']->name,'url'=>"volunteer/temple/".$this->data['temple']->id,'active'=>''),
            array('name'=> '义工活动','url'=>'','active'=>'active')
            );
        $this->load->view('temple/volunteer/list',$this->data);
    }

    //volunteer single
    public function id($templeid,$id){
         if($this->session->userdata('usertype') != 'master'){
            $this->session->set_userdata('page_templeid',$templeid);
            $this->session->set_userdata('templeid',$templeid);
        }
        $this->data['volunteer'] = $this->volunteer_mdl->info($id);
        $this->data['temple'] = $this->temple_mdl->info($templeid);
        $this->data['title'] = '义工活动';
        $this->data['crumb'] = array(
            array('name'=> $this->data['temple']->name,'url'=>"volunteer/temple/".$this->data['temple']->id,'active'=>''),
            array('name'=> '义工活动','url'=>"volunteer/temple/".$this->data['temple']->id,'active'=>''),
            array('name'=> '内容','url'=>'','active'=>'active')
            );
        $this->data['register_list'] = $this->volunteer_mdl->get_register($id);
        $this->data['is_register'] = $this->volunteer_mdl->is_register($this->session->userdata('id'),$id);
        $this->data['question_list'] = $this->question_mdl->get();
        $this->data['option_list'] = $this->question_mdl->get_option();
        $this->session->set_userdata('jump_from','volunteer/id/'.$templeid.'/'.$id);
        $this->load->view('temple/volunteer/info',$this->data);
    }
}
