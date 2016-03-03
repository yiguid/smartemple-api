<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/visit.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/temple.css">
<div class="main row">

<div class="container">
	<div class="order-alert alert alert-info" role="alert">
		<?php echo $temple->name?>感谢您的护持与供养！请留下您的联系方式！<br/>阿弥陀佛！功德无量！
	</div>
	<div class="pay-method">
		<div class="alert alert-info">
			<h4>我想注册登记，佛前留名，功德常在。</h4>
			<div class="wifi-info-input" id="send_captcha">
				手机号：
				<input name="mobile" id="mobile" style="width:156px;">
			</div>
			<div class="wifi-info-input" id="verify_captcha">
				验证码：
				<input name="captcha" id="captcha" style="width:70px;">
				<button id="captcha-btn" class="btn btn-sm btn-default" data-loading-text="发送中..." autocomplete="off" onclick="javascript:default_commit_mobile('<?php echo base_url();?>')">获取验证码</button>
			</div>
			<div class="wifi-info-input" id="reg-login">
				<button class="btn btn-sm btn-success"
				 onclick="javascript:verify_mobile_with_donation_order_id('<?php echo base_url();?>','<?php echo $donation_order_id;?>')">注册</button>
				
			</div>
		</div>
		<div class="alert alert-info">
			<h4>我想匿名供养，只留下一片虔诚之心。</h4>
			<a class="btn btn-sm btn-default" href="<?php echo base_url()."user/qf";?>">匿名供养</a>
		</div>	

	</div>
</div>
</div>
<?php $this->load->view('footer');?>