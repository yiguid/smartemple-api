<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
    public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = '新闻';
        $this->load->model('temple_mdl');
        $this->load->model('iptool_mdl');
        $this->load->model('news_mdl');
        $this->data['temple_nav'] = 'news';
        $this->data['title'] = '新闻';
	}

	public function index()
	{
        $templeid = $this->session->userdata('templeid');
        if($templeid != null && $templeid != "")
            redirect('news/temple/'.$templeid,'refresh');
        else
            redirect('index','refresh');
	}

    //news list
    public function temple($templeid)
    {
        //从页面直接访问，先设置templeid到session
        //必须不能是master用户，要不然管理就混乱了
        if($this->session->userdata('usertype') != 'master'){
            $this->session->set_userdata('page_templeid',$templeid);
            $this->session->set_userdata('templeid',$templeid);
        }
        $this->data['news_list'] = $this->news_mdl->get(1,$templeid);
        $this->data['temple'] = $this->temple_mdl->info($templeid);
        $this->data['title'] = '寺院新闻';
        $this->data['crumb'] = array(
            array('name'=> $this->data['temple']->name,'url'=>"news/temple/".$this->data['temple']->id,'active'=>''),
            array('name'=> '寺院新闻','url'=>'','active'=>'active')
            );
        $this->load->view('temple/news/list',$this->data);
    }

    //news single
    public function id($templeid,$id){
         if($this->session->userdata('usertype') != 'master'){
            $this->session->set_userdata('page_templeid',$templeid);
            $this->session->set_userdata('templeid',$templeid);
        }
        $this->data['news'] = $this->news_mdl->info($id);
        $this->data['temple'] = $this->temple_mdl->info($templeid);
        $this->data['title'] = '寺院新闻';
        $this->data['crumb'] = array(
            array('name'=> $this->data['temple']->name,'url'=>"news/temple/".$this->data['temple']->id,'active'=>''),
            array('name'=> '寺院新闻','url'=>"news/temple/".$this->data['temple']->id,'active'=>''),
            array('name'=> '内容','url'=>'','active'=>'active')
            );
        $this->load->view('temple/news/info',$this->data);
    }
}
