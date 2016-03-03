<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
?>
<div class="slider row">
	<div class="main container">
		<div class="info">
			<div class="wifi-info">
				已有寺院
				<a href="<?php echo base_url()."register"?>">新寺院登记 <span class="glyphicon glyphicon-info-sign"></span></a>
				<form action="admin" method="post" class="form-horizontal" role="form">
				    <div class="wifi-info-input">
				    用户名：
				      <input type="username" name="username" style="width:156px;" id="username" placeholder="用户名"><?php echo form_error('username')?>
				  </div>
				  <div class="wifi-info-input">
				  	密　码：
				      <input type="password" name="password" style="width:156px;" id="password" placeholder="密码"><?php echo form_error('password')?>
				      <p><?php if(isset($login_info)) echo $login_info;?></p>
				  </div>
				 	<div class="wifi-info-input" id="reg-login">
				      <button type="submit" class="btn btn-sm btn-primary btn-block">登录</button>
				    </div>
				</form>
			</div>
		</div>
		<div class="slider-slogan">心 动 行 动 间<br/>

		</div>
	</div>
	<div class="slider-back"></div>
</div>
<div class="slogan text-center row">
<div class="container">
	<p>佛告诉毗耶娑，有人虽做了好事，但挟带了功利性的不清净心理，不算真布施。<br/>——佛说三十三种不清净布施</p>
</div>
</div>
<?php $this->load->view('footer');?>