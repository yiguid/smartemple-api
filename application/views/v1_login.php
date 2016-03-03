<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_index_header');
?>
			<div class="v1-index-choose">
				<div class="v1-w100"><div class="v1-index-choose-slogan">游山参禅 乐水悟道 自在逍遥</div></div>
				<div class="v1-w100 v1-index-choose-btn">
				居士登录
				</div>
				<form action="login" method="post" class="form-horizontal" role="form">
				    <div class="v1-w100 v1-index-choose-btn">
				    用户名：
				      <input type="username" name="username" style="width:156px;" id="username" placeholder="用户名/手机号"><?php echo form_error('username')?>
				  </div>
				  <div class="v1-w100 v1-index-choose-btn">
				  	密　码：
				      <input type="password" name="password" style="width:156px;" id="password" placeholder="密码"><?php echo form_error('password')?>
				      <p class="login-info"><?php if(isset($login_info)) echo $login_info;?></p>
				  </div>
				 	<div class="v1-w100 v1-index-choose-btn" id="reg-login">
				      <a href="<?php echo base_url()."visit/register"?>">新用户注册 <span class="glyphicon glyphicon-info-sign"></span></a>
				      <button type="submit" class="v1-btn-brown">登录</button>
				    </div>
				    <div class="v1-w100 v1-index-choose-btn">
				      <a style="margin:2px 0px;color:white;" href="<?php echo base_url().'user'?>" class="v1-btn-grey">免登录入口</a>
				    </div>
				</form>
			</div>
			<!-- 后面两个/div是因为v1_index_header前面有两个div对应的,为了全屏背景图-->
		</div>
	</div>
<?php $this->load->view('v1_footer');?>