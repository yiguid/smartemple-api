<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Qrcode_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
		include APPPATH."third_party/phpqrcode.php"; 
	}

	//获取总数目
	public function get_donation_qrcode($templeid, $id)
	{
		$QRCODE_PNG_DIR = "./assets/qrcode/";
		$QRCODE_URL = base_url()."assets/qrcode/";
		if (!file_exists($QRCODE_PNG_DIR))
   			mkdir($QRCODE_PNG_DIR);
		$filename = $QRCODE_PNG_DIR."donation-".$templeid."-".$id.".png";
		if(!file_exists($filename))
			QRcode::png(base_url()."donation/item/".$templeid."/".$id,$filename,'H',6,2);
		return $QRCODE_URL.basename($filename);
	}

	public function get_donation_wxpay_qrcode($templeid, $donationid, $content)
	{
		$QRCODE_PNG_DIR = "./assets/qrcode/";
		$QRCODE_URL = base_url()."assets/qrcode/";
		if (!file_exists($QRCODE_PNG_DIR))
   			mkdir($QRCODE_PNG_DIR);
		$filename = $QRCODE_PNG_DIR."donation-".$templeid."-".$donationid."-wxpay.png";
		//if(!file_exists($filename))
		//实时获取
		QRcode::png($content,$filename,'H',6,2);
		return $QRCODE_URL.basename($filename);
	}
}
?>