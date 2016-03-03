<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SMSService extends CI_Controller {

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
		$this->data['title'] = '短信系统';
		$this->load->model('sms_mdl');
	}
	public function index()
	{
		echo 'sms';
	}
	public function send($to_mobile,$from_mobile,$from_name,$from_content,$pwd)
	{
		if($pwd == 'ddg')
			$this->sms_mdl->send_sms('1ca6d531984fed9cb4e276990f8c45d1'
							,'【智慧寺院】欢迎'.$from_name.'使用服务，服务内容'.$from_content.'，联系电话是'.$from_mobile.'，请及时取得联系。'
							//,'【智慧寺院】亲爱的'.$from_name.'，您的验证码是'.$from_content.'。有效期为'.$from_mobile.'小时，请尽快验证'
							,$to_mobile);
		echo "<a href=\"javascript:history.back(-1)\">Success! Back...</a>";
		//echo "{\"code\": 0,\"msg\": \"OK\",\"result\": {\"count\": 1, \"fee\": 1,  \"sid\": 1097 }}";
	}

	public function send_raw($mobile,$content)
	{
		echo $this->sms_mdl->send_sms('1ca6d531984fed9cb4e276990f8c45d1',$content,$mobile);
	}

	public function send_post()
	{
		//from mobile
		$mobile = $this->input->post('mobile');
		$name = $this->input->post('name');
		$content = $this->input->post('content');
		$this->send('18611728343',$mobile,$name,$content,'ddg');
	}

	public function send_post_raw()
	{
		$mobile = $this->input->post('mobile');
		$content = $this->input->post('content');
		$this->send_raw($mobile,$content);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */