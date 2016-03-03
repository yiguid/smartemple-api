<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qf extends CI_Controller {
    public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('wishboard_mdl');
        $this->load->model('temple_mdl');
        $this->load->model('iptool_mdl');
        $this->data['nav'] = 'qf';
        $this->data['temple_nav'] = 'qf';
        $this->data['title'] = '1祈福墙';
	}

	public function index()
	{
        $templeid = $this->session->userdata('templeid');
        $this->data['wish'] = $this->wishboard_mdl->get_history($templeid);
        $this->data['reply'] = $this->wishboard_mdl->get_history($templeid,false);
        $this->data['temple'] = $this->temple_mdl->info($templeid);
        $this->session->set_userdata('templeid',$templeid);
        $this->data['title'] = '祈福墙 - '.$this->data['temple']->name;
        $this->load->view('wishboard/qf',$this->data);
	}

    public function temple($templeid)
    {
        //从页面直接访问，先设置templeid到session
        //必须不能是master用户，要不然管理就混乱了
        if($this->session->userdata('usertype') != 'master'){
            $this->session->set_userdata('page_templeid',$templeid);
            $this->session->set_userdata('templeid',$templeid);
        }
        $this->data['wish'] = $this->wishboard_mdl->get_history($templeid);
        $this->data['reply'] = $this->wishboard_mdl->get_history($templeid,false);
        $this->data['temple'] = $this->temple_mdl->info($templeid);
        $this->data['title'] = '祈福墙 - '.$this->data['temple']->name;
        $this->load->view('wishboard/qf',$this->data);
    }

    public function newqf($userid, $content, $parentid)
    {
        if($userid == "")
            $userid = "匿名";
        if($content == "")
            $content = "祈福";
        $datetime = date("Y-m-d H:i:s");
        $templeid = $this->session->userdata('templeid');
        $ipInfos = $this->iptool_mdl->GetIpLookup($this->iptool_mdl->GetIp());
        $location = $ipInfos['province'].$ipInfos['city'];
        $param = array(
            'userid'=>$userid,
            'content'=>$content,
            'parentid'=>$parentid,
            'datetime'=>$datetime,
            'templeid'=>$templeid,
            'location'=>$location);
        $this->wishboard_mdl->add($param);
        redirect('qf/temple/'.$templeid);
    }

    public function add()
    {
        $userid = $this->input->post('userid');
        $content = $this->input->post('content');
        $this->newqf($userid,$content,0);
    }

    public function reply()
    {
        $userid = $this->session->userdata('realname');
        $content = $this->input->post('content');
        $parentid = $this->input->post('parentid');
        $this->newqf($userid,$content,$parentid);
    }
}
