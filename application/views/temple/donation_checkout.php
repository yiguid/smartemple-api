<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/visit.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/temple.css">
<div class="main row">

<div class="container">
	<div class="order-alert alert alert-info" role="alert">
		<?php echo $temple->name?>感谢您的护持与供养！<br/>阿弥陀佛！功德无量！
	</div>
	<div class="checkout-total">
		支付总金额：<?php echo $this->cart->total();?>
	</div>
	<div class="pay-method">
		<a href="<?php echo base_url();?>alipay" class="btn btn-warning btn-lg">使用支付宝支付</a>
	</div>
	<div class="pay-method">
		<a href="<?php echo base_url();?>wxpay" class="btn btn-success btn-lg">使用微信支付</a>
	</div>
	<!-- <div class="pay-method">
		<a href="javascript:construction()" class="btn btn-info btn-lg">使用网银支付</a>
	</div>
	<div class="pay-method">
		<a href="javascript:construction()" class="btn btn-primary btn-lg">支付订金</a>
	</div> -->
</div>
</div>
<?php $this->load->view('footer');?>