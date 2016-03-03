<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_index_header');
?>
			<div class="v1-index-choose">
				<div class="v1-w100"><div class="v1-index-choose-slogan">请选择账户类型登录</div></div>
				<div class="v1-w100 v1-index-choose-btn">
				<!-- <select name="usertype" class="usertype" id="usertype" onchange= "change_slogan()">
					<option value="default">请选择</option>
					<option value="master">法师</option>
					<option value="user">居士</option>
					<option value="corp">企业</option>
				</select> -->
				<a href="<?php echo base_url('admin')?>">法师</a>
				</div>
				<div class="v1-w100 v1-index-choose-btn">
				<a href="<?php echo base_url('user')?>">居士</a></div>
				<div class="v1-w100 v1-index-choose-btn">
				<a href="javascript:show_alert('功能尚未开放','广种福田，无量功德<br/>敬请期待...')">企业</a></div>
			</div>
			<form action="<?php echo base_url();?>login" method="post">
			<div class="v1-index-login">
				<div class="v1-w30">
					<div class="v1-index-input">
					<input type="text" size="20" placeholder="用户名" name="username" id="username"/>
					</div>
					<span class="v1-index-register"><a href="#">新用户注册</a></span>
				</div>
				<div class="v1-w20"></div>
				<div class="v1-w30">
					<div class="v1-index-input">
					<input type="password" size="20" placeholder="密码" name="password" id="password"/>
					</div>
					<div class="v1-index-btn">
						<button type="submit">登录</button>
					</div>
				</div>
				<div class="v1-w20">
					<span class="v1-index-forget"><a href="#">忘记密码</a></span>	
				</div>
			</div>
			</form>
		</div>
	</div>

<?php $this->load->view('alert_modal');?>
<?php $this->load->view('v1_footer');?>