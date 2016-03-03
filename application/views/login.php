<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
?>
<div class="slider row">
	<div class="main container">
		<div class="info">
			<div class="text-right">
				<!-- <h3><?php echo $temple->name?></h3>
				<small><a href="<?php echo base_url()."visit";?>"><span class="glyphicon glyphicon-refresh"></span>返回地图</a></small> -->
			</div>
			<div class="wifi-info">
				用户登录
				<a href="<?php echo base_url()."visit/register"?>">新用户注册 <span class="glyphicon glyphicon-info-sign"></span></a>
				<form action="login" method="post" class="form-horizontal" role="form">
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
				      <a style="margin:2px 0px;color:white;" href="<?php echo base_url().'user'?>" class="btn btn-sm btn-buddha-lt btn-block">免登录入口</a>
				    </div>
				</form>
			</div>
		</div>
		<div class="slider-slogan">心 动 行 动 间<br/>
			<!-- <small><a target="_blank" 
		href="<?php if(isset($temple->planlink)) echo $temple->planlink; else echo base_url('plan');?>">
		<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
				查看寺院规划</a></small><br/>
			<small>
				<a target="_blank" href="<?php if(isset($temple->intro)) echo $temple->intro; else echo base_url('plan');?>"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>
				观看寺院和住持简介</a></small> -->
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