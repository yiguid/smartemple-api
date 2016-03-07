<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = '大德 - 智慧寺院网';
		$this->data['nav'] = 'master';
		$this->load->model('master_mdl');
		$this->load->model('temple_mdl');
		$this->load->model('wishboard_mdl');
		$this->load->model('timeline_mdl');
		$this->load->model('iptool_mdl');
		$this->load->model('user_mdl');
		$this->load->model('wechatjssdk_mdl');
	}

	public function index()
	{
        //$this->output->cache(1);
		$this->data['master_voice_list'] = $this->master_mdl->get_index_show(1000);
        $this->data['master_list'] = $this->master_mdl->get_show();
		shuffle($this->data['master_list']);
		$this->data['user_nav'] = 'master';
        //设置分享信息
        $this->data['sign_package'] = $this->wechatjssdk_mdl->getSignPackage();
        $date_str = date('Y年m月d日');
        $this->data['share_title'] = $date_str."全国大德法师语音开示-欢迎转发，功德无量！";
        $this->data['share_desc'] = '众生皆具如来智慧德相，自性回归证生命大自在。穿越时光，跟随法师修行布道的脚步！';
        $this->data['share_img'] = "assets/images/smartemple-logo.png";
        $this->data['share_link'] = base_url().'user/master';

		$this->load->view('user/master/index',$this->data);
	}

	public function qf($masterid, $templeid)
    {
    	if(!$this->auth->logged_in())
        {
            redirect('login','refresh');
        }
        $userid = $this->input->post('userid');
        $content = $this->input->post('content');
        if($userid == "")
            $userid = "匿名";
        if($content == "")
            $content = "祈福";
        $datetime = date("Y-m-d H:i:s");
        $ipInfos = $this->iptool_mdl->GetIpLookup($this->iptool_mdl->GetIp());
        $location = $ipInfos['province'].$ipInfos['city'];
        $param = array(
            'userid'=>$userid,
            'usertype'=>$this->session->userdata('usertype'),
            'content'=>$content,
            'parentid'=>0,
            'datetime'=>$datetime,
            'templeid'=>$templeid,
            'fromurl' => 'master/qf',
            'ip' => $this->iptool_mdl->GetIp(),
            'userrealid' => $this->session->userdata('id'),
            'location'=>$location);
        $this->wishboard_mdl->add($param);
        redirect('user/master/id/'.$masterid);
    }

	public function id($id){
		$this->data['master'] = $this->master_mdl->info($id);
		if($this->data['master'] == null)
			show_404();
		//增加人气
        //启用静态页面后，到ajax里面执行
		//$this->master_mdl->add_views($id,$this->data['master']->views + 1);
        
        //$this->output->cache(0.5);
		//echo $this->data['master']->likes;
        $this->data['title'] = $this->data['master']->realname;
        $this->data['temple'] = $this->temple_mdl->info($this->data['master']->templeid);
        $this->data['wish'] = $this->wishboard_mdl->get_history($this->data['master']->templeid);
        $this->data['qa'] = $this->wishboard_mdl->get_answer($this->data['master']->templeid,10);
        $this->data['timeline'] = $this->timeline_mdl->get(1,$this->data['master']->templeid);
        $years = array();
        foreach ($this->data['timeline'] as $tl) {
        	//获取年份信息
        	$year = date('Y', strtotime($tl->datetime));
        	if(!array_key_exists($year, $years))
        		$years[$year] = array();
        	$month = date('m', strtotime($tl->datetime));
        	if(!in_array($month, $years[$year]))
        		$years[$year][] = $month;
        }
        $this->data['timeline_years'] = $years;
        //设置分享信息
		$this->data['sign_package'] = $this->wechatjssdk_mdl->getSignPackage();
		$this->data['share_title'] = '欢迎关注'.$this->data['master']->realname."的时光轴";
		$this->data['share_desc'] = '已有'.$this->data['master']->views.'人支持，穿越时光，跟随'.$this->data['master']->realname.'修行布道的脚步！';
		$this->data['share_img'] = $this->data['master']->avatar;
		$this->data['share_link'] = base_url().'user/master/id/'.$this->data['master']->id;

		$this->session->set_userdata('jump_from','user/master/id/'.$id);
        $this->load->view('user/master/info',$this->data);
	}

    public function iviews(){
        extract($_REQUEST);
        $this->data['master'] = $this->master_mdl->info($id);
        //增加人气
        $this->master_mdl->add_views($id,$this->data['master']->views + 1);
    }

	public function ilike(){
		extract($_REQUEST);
		$this->data['master'] = $this->master_mdl->info($id);
		//增加喜爱
		$this->master_mdl->update_detail($id,array('likes' => $this->data['master']->likes + 1));
	}
}