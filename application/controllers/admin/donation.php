<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donation extends CI_Controller {

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
		if(!$this->auth->logged_in() || !$this->auth->is_admin($this->session->userdata('username')))
		{
			redirect('login','refresh');
		}
		$this->data['title'] = '智慧寺院 - 智慧供养';
		$this->data['nav'] = 'donation';
		$this->data['nav_info'] = '管理后台';
		$this->data['sidebar'] = 'index';
		$this->load->model('temple_mdl');
		$this->load->model('donation_mdl');
	}

	public function index()
	{	
		$this->data['temple'] = $this->temple_mdl->get();
		$this->data['crumb'] = array(array('name'=> '智慧供养','url'=>'donation','active'=>'active'));
		$this->load->view('admin/donation', $this->data);
	}

	public function temple($templeid)
	{
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['donation'] = $this->donation_mdl->get($templeid);
		$this->data['donation_info'] = $this->donation_mdl->get_temple_order_income($templeid);
		$this->data['crumb'] = array(
			array('name'=> '智慧供养','url'=>'admin/donation','active'=>''),
			array('name'=> $this->data['temple']->name,'url'=>'','active'=>'active')
			);
		$this->load->view('admin/donation_list',$this->data);
	}

	public function recent($templeid = 0){
		$this->data['recent_order'] = $this->donation_mdl->get_recent_order($templeid);
		$this->load->view('admin/donation_recent_order',$this->data);
	}

	public function clear()
	{
		$this->temple_mdl->clear_donation();
		$this->data['temple'] = $this->temple_mdl->get();
		$this->data['crumb'] = array(array('name'=> '智慧供养','url'=>'donation','active'=>'active'));
		$this->load->view('admin/donation', $this->data);
	}

	public function item($donationid)
	{
		$this->data['donation'] = $this->donation_mdl->info($donationid);
		$this->data['temple'] = $this->temple_mdl->info($this->data['donation']->templeid);
		$this->data['crumb'] = array(
			array('name'=> '智慧供养','url'=>'admin/donation','active'=>''),
			array('name'=> $this->data['temple']->name,'url'=>'admin/donation/temple/'.$this->data['temple']->id,'active'=>''),
			array('name'=> $this->data['donation']->name,'url'=>'','active'=>'active'),
			);
		$this->load->view('admin/donation_item',$this->data);
	}

	public function import($templeid = ''){
		$config['upload_path'] = './application/uploads/';
		$config['allowed_types'] = 'xls|xlsx|png';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors('<p>', '</p>'));
			echo "<!DOCTYPE html>
				<html lang=\"zh-cn\">
				    <head>
				        <meta charset=\"utf-8\">";
			foreach($error as $item)
			{
				show_error($item);
			}
		} 
		else
		{
			$data = $this->upload->data();
			$filepath = $data['full_path'];//获取上传文件的路径
			$count = 0;//计算新增数据数量
			$exist_count = 0; //计算导入表里已存在的数据个数

			require_once APPPATH."third_party/PHPExcel/PHPExcel.php";
			require_once APPPATH."third_party/PHPExcel/PHPExcel/IOFactory.php";
			require_once APPPATH."third_party/PHPExcel/PHPExcel/Reader/Excel5.php";
			require_once APPPATH."third_party/PHPExcel/PHPExcel/Reader/Excel2007.php";

			$PHPExcel = new PHPExcel();
			$PHPReader = new PHPExcel_Reader_Excel2007();
			if (!$PHPReader->canRead($filepath))
			{
				$PHPReader = new PHPExcel_Reader_Excel5();
				if (!$PHPReader->canRead($filepath))
				{
					show_error('上传的文件无法读取');
				}
			}
			$PHPExcel = $PHPReader->load($filepath);
			$sheet = $PHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow(); // 取得总行数，从第1行开始
			if($templeid == '')
				//获取所有寺院的id
				$temples = $this->temple_mdl->get();

			for ($row = 1; $row <= $highestRow; $row++)
			{
				$name = $sheet->getCellByColumnAndRow(1, $row)->getValue();
				$type = $sheet->getCellByColumnAndRow(2, $row)->getValue();
				$info = $sheet->getCellByColumnAndRow(3, $row)->getValue();
				$img = $sheet->getCellByColumnAndRow(4, $row)->getValue();
				$price = $sheet->getCellByColumnAndRow(5, $row)->getValue();
				$amount = $sheet->getCellByColumnAndRow(6, $row)->getValue();
				//如果有templeid
				if($templeid != '')
					$this->donation_mdl->add(array('templeid' => $templeid,'name' => $name,'type' => $type,'info' => $info, 'img'=>$img, 'price' => $price,'amount' => $amount));
				else{
					foreach ($temples as $t) {
						# code...
						$this->donation_mdl->add(array('templeid' => $t->id,'name' => $name,'type' => $type,'info' => $info, 'img'=>$img, 'price' => $price,'amount' => $amount));
					}
				}
				$count += 1;
			}
			$newname = date("YmdHis",time());
			$file_path = $data['file_path'];
			$newpath = $file_path.$newname;
			rename($filepath,$newpath);
			echo "<!DOCTYPE html>
				<html lang=\"zh-cn\">
				    <head>
				        <meta charset=\"utf-8\">";
			echo '成功添加'.$count.'条数据.点击';
			if($templeid != '')
				echo anchor('admin/donation/temple/'.$templeid,'供养管理');
			else
				echo anchor('admin/donation','供养管理');
			echo '返回供养管理界面';
			//redirect('admin/data','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */