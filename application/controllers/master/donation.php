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
		if(!$this->auth->logged_in() || $this->session->userdata('usertype') != 'master')
		{
			redirect('login','refresh');
		}
		$this->load->model('donation_mdl');
		$this->load->model('user_mdl');
		$this->load->model('temple_mdl');
		$this->data['title'] = '智慧寺院 - 智慧供养';
		$this->data['nav'] = 'donation';
		$this->data['temple'] = $this->temple_mdl->info($this->session->userdata('templeid'));
		$this->data['nav_info'] = $this->data['temple']->name;
		$this->data['sidebar'] = 'donation';
		$templeid = $this->session->userdata('templeid');
	}

	public function index()
	{	
		$this->data['sidebar'] = 'index';
		$templeid = $this->session->userdata('templeid');
		//设置page_templeid
		$this->session->set_userdata('page_templeid',$templeid);
		$this->data['donation_info'] = $this->donation_mdl->get_temple_order_income($templeid);
		$this->data['order'] = $this->donation_mdl->get_order('',$templeid);
		$this->load->view('master/donation', $this->data);
	}

	public function order($orderid)
	{
		$this->data['sidebar'] = 'index';
		$templeid = $this->session->userdata('templeid');
		$this->data['order_items'] = $this->donation_mdl->get_order_items($orderid);
		$this->data['order'] = $this->donation_mdl->get_order_info($orderid);
		$this->load->view('master/donation_order_items',$this->data);
	}

	public function donations()
	{
		$templeid = $this->session->userdata('templeid');
		$this->data['donation'] = $this->donation_mdl->get($templeid);
		$this->load->view('master/donations', $this->data);
	}

	public function preview()
	{
		$templeid = $this->session->userdata('templeid');
		$this->data['temple'] = $this->temple_mdl->info($templeid);
		$this->data['jiancai'] = $this->donation_mdl->get_by_type($templeid,'建材');
		$this->data['huamu'] = $this->donation_mdl->get_by_type($templeid,'花木');
		$this->load->view('master/preview', $this->data);
	}

	public function add()
	{
		$this->form_validation->set_rules('name','名称','required|trim');
		$this->form_validation->set_rules('type','类别','required|trim');
		$this->form_validation->set_rules('info','信息','required|trim');
		$this->form_validation->set_rules('price','价格','required|trim');
		$this->form_validation->set_rules('amount','数量','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('master/donation_add',$this->data);
		}else{
			$templeid = $this->session->userdata('templeid');
			$name = $this->input->post('name');
			$type = $this->input->post('type');
			$info = $this->input->post('info');
			$price = $this->input->post('price');
			$amount = $this->input->post('amount');
			//上传图片
			$config['upload_path'] = './templeimg/donation';
			$config['allowed_types'] = 'jpg|png|gif';
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
				$newname = $templeid.'-'.date("YmdHis",time()).$data['file_ext'];
				$file_path = $data['file_path'];
				$newpath = $file_path.$newname;
				rename($data['full_path'],$newpath);
				$img = 'templeimg/donation/'.$newname;//获取上传文件的路径
			}
			$this->donation_mdl->add(array('templeid' => $templeid,'name' => $name,'type' => $type,'info' => $info,'img' => $img,'price' => $price,'amount' => $amount));
			redirect('master/donation/donations','refresh');
		}
	}

	public function id($id)
	{
		$this->data['entry'] = $this->donation_mdl->info($id);
		$this->load->view('master/donation_info',$this->data);
	}

	public function edit($id)
	{	
		$templeid = $this->session->userdata('templeid');
		$this->data['entry'] = $this->donation_mdl->info($id);
		$this->form_validation->set_rules('name','名称','required|trim');
		$this->form_validation->set_rules('type','类别','required|trim');
		$this->form_validation->set_rules('info','信息','required|trim');
		$this->form_validation->set_rules('price','价格','required|trim');
		$this->form_validation->set_rules('amount','数量','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('master/donation_edit',$this->data);
		}else{
			$name = $this->input->post('name');
			$type = $this->input->post('type');
			$info = $this->input->post('info');
			$price = $this->input->post('price');
			$amount = $this->input->post('amount');
			//上传图片
			$config['upload_path'] = './templeimg/donation';
			$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('userfile'))
			{
				// $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
				// echo "<!DOCTYPE html>
				// 	<html lang=\"zh-cn\">
				// 	    <head>
				// 	        <meta charset=\"utf-8\">";
				// foreach($error as $item)
				// {
				// 	show_error($item);
				// }
				$this->donation_mdl->update($id, array('name' => $name,'type' => $type,'info' => $info,'price' => $price,'amount' => $amount));
			}
			else
			{
				$data = $this->upload->data();
				$newname = $templeid.'-'.date("YmdHis",time()).$data['file_ext'];
				$file_path = $data['file_path'];
				$newpath = $file_path.$newname;
				rename($data['full_path'],$newpath);
				$img = 'templeimg/donation/'.$newname;//获取上传文件的路径
				$this->donation_mdl->update($id, array('name' => $name,'type' => $type,'info' => $info,'img' => $img,'price' => $price,'amount' => $amount));
			}
			redirect('master/donation/donations','refresh');
		}
	}

	public function delete($id)
	{
		$this->donation_mdl->delete($id);
		redirect('master/donation/donations','refresh');
	}

	public function delete_order($orderid)
	{
		$this->donation_mdl->delete_order($orderid);
		redirect('master/donation','refresh');
	}

	public function cashpay_order($orderid)
	{
		//支付成功
		$this->donation_mdl->update_order($orderid, array('status' => '登记成功'));
	    //更新供养物的数量信息
	    $order_items = $this->donation_mdl->get_order_items($orderid);
	    foreach ($order_items as $item) {
	    	$this->donation_mdl->update_soldcount($item->id);
	    }
	    $this->order($orderid);
	}

	public function step1()
	{
		$this->cart->destroy();
		$this->data['sidebar'] = 'index';
		$this->data['donation'] = $this->donation_mdl->get_available($this->session->userdata('templeid'));
		$this->load->view('master/donation_step1',$this->data);
	}

	public function step2()
	{
		if($this->cart->total() == 0)
			redirect('master/donation/step1','refresh');
		$this->data['sidebar'] = 'index';
		$this->data['user'] = $this->user_mdl->get();
		$this->load->view('master/donation_step2',$this->data);
	}

	public function add_order()
	{
		$this->form_validation->set_rules('contact','联系人','required|trim');
		$this->form_validation->set_rules('mobile','联系电话','required|trim');
		$this->form_validation->set_rules('username','用户名','trim');
		if($this->form_validation->run() == FALSE){
			$this->data['sidebar'] = 'index';
			$this->load->view('master/donation_step2',$this->data);
		}else{
			//生成订单
			$contact = $this->input->post('contact');
			$mobile = $this->input->post('mobile');
			$username = $this->input->post('username');
			$total = $this->cart->total();
			$status = '手动登记订单';
			$ordertime = date("Y-m-d H:i:s");
			$id = "D".date("YmdHis").substr(md5($ordertime),0,6);
			$templeid = $this->session->userdata('templeid');
			$result = $this->donation_mdl->add_order(array('id'=>$id,'contact' => $contact,'mobile' => $mobile
				,'username' => $username,'total' => $total,'status' => $status,'ordertime' => $ordertime,'templeid' => $templeid));
			if($result)
				$this->session->set_userdata('donation_order_id',$id);
			redirect('master/donation/step3','refresh');
		}
	}

	public function step3()
	{
		//第三步
		$this->data['sidebar'] = 'index';
		//获取订单信息
		$donation_order_id = $this->session->userdata('donation_order_id');
		$this->data['order'] = $this->donation_mdl->get_order_info($donation_order_id);
		//供养信息在cart中取得
		$this->load->view('master/donation_step3',$this->data);
	}

	public function step_commit()
	{
		//获取订单信息
		$donation_order_id = $this->session->userdata('donation_order_id');
		$this->data['order'] = $this->donation_mdl->get_order_info($donation_order_id);
		//生成order_item
		foreach ($this->cart->contents() as $item) {
			$oi = array('orderid' => $donation_order_id,'donationid' => $item['id'],'count' => $item['qty']);
			$this->donation_mdl->add_order_item($oi);
			//更新供养物的数量信息
			$this->donation_mdl->update_soldcount($item['id']);
		}
		//更新订单信息
		$this->donation_mdl->update_order($donation_order_id, array('status' => '登记成功'));
		redirect('master/donation/step_print','refresh');
	}

	public function step_print()
	{
		//获取订单信息
		$donation_order_id = $this->session->userdata('donation_order_id');
		$this->data['order'] = $this->donation_mdl->get_order_info($donation_order_id);
	    $this->load->view('master/donation_print',$this->data);
	}

	//导出数据库信息
	public function export()
	{
		require_once APPPATH."third_party/PHPExcel/PHPExcel.php";
		require_once APPPATH."third_party/PHPExcel/PHPExcel/IOFactory.php";
		require_once APPPATH."third_party/PHPExcel/PHPExcel/Writer/Excel5.php";
		require_once APPPATH."third_party/PHPExcel/PHPExcel/Writer/Excel2007.php";

		$myExcel = new PHPExcel();
  
		// 创建文件格式写入对象实例
		$myWriter = new PHPExcel_Writer_Excel5($myExcel);

		//设置文档基本属性   
		$objProps = $myExcel->getProperties();
		$objProps->setCreator("smartemple");
		$objProps->setLastModifiedBy("smartemple");
		$objProps->setTitle("供养管理");
		$objProps->setSubject("供养管理");
		$objProps->setDescription("供养管理");
		$objProps->setKeywords("供养管理");
		$objProps->setCategory("供养管理");

		//设置当前的sheet索引，用于后续的内容操作
		//一般只有在使用多个sheet的时候才需要显示调用
		//缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0
		$myExcel->setActiveSheetIndex(0);

		$myActSheet = $myExcel->getActiveSheet();
		  
		//设置当前活动sheet的名称
		$myActSheet->setTitle('Sheet1');

		// $checked_array = explode(",",$checked_string);
		// $length = count($checked_array)-1;
		// $select_string = substr($checked_string,0,-1);
		$count = 1;
		$templeid = $this->session->userdata('templeid');
		$result = $this->donation_mdl->get($templeid);
		$fields = $this->db->list_fields('donation');
		foreach($result as $item)
		{
			$column = 'A';
			foreach ($fields as $field)
			{
				$myActSheet->setCellValueExplicit("$column$count", $item->$field, PHPExcel_Cell_DataType::TYPE_STRING);
				$column++;
			}
			$count++;
		}
		// 到文件
		$outputfilename = date('Y_m_d_H_i_s',time()).'.xls';
		$myWriter->save(APPPATH."output/$outputfilename");
		$data = file_get_contents(APPPATH."output/$outputfilename"); // 读文件内容
		$name = 'output'.date('Y_m_d_H_i_s',time()).'.xls';
		force_download($name, $data); 
		//echo '<a href="'.site_url().'user/download/'.$outputfilename.'" >下载</a>';
	}

	public function download($filename)
	{
		$data = file_get_contents(APPPATH."output/$filename"); // 读文件内容
		$name ='output.xls';
		force_download($name, $data); 
	}

	//首先利用文件上传类将文件上传至服务器，再利用PHPExcel将数据导入到数据库
	public function import()
	{
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
			for ($row = 1; $row <= $highestRow; $row++)
			{
				$templeid = $this->session->userdata('templeid');
				$name = $sheet->getCellByColumnAndRow(1, $row)->getValue();
				$type = $sheet->getCellByColumnAndRow(2, $row)->getValue();
				$info = $sheet->getCellByColumnAndRow(3, $row)->getValue();
				$img = $sheet->getCellByColumnAndRow(4, $row)->getValue();
				$price = $sheet->getCellByColumnAndRow(5, $row)->getValue();
				$amount = $sheet->getCellByColumnAndRow(6, $row)->getValue();
				$this->donation_mdl->add(array('templeid' => $templeid,'name' => $name,'type' => $type,'info' => $info, 'img'=>$img, 'price' => $price,'amount' => $amount));
				$count += 1;
			}
			$newname = date("YmdHis",time()).$data['file_ext'];
			$file_path = $data['file_path'];
			$newpath = $file_path.$newname;
			rename($filepath,$newpath);
			echo "<!DOCTYPE html>
				<html lang=\"zh-cn\">
				    <head>
				        <meta charset=\"utf-8\">";
			echo '成功添加'.$count.'条数据.点击';
			echo anchor('master/donation/donations','供养管理');
			echo '返回供养管理界面';
			//redirect('admin/data','refresh');
		}
	}//
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */