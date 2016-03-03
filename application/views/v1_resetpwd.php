<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_index_header');
?>
	<div class="v1-index-choose">
		<div class="v1-w100"><div class="v1-index-choose-slogan">游山参禅 乐水悟道 自在逍遥</div></div>
			<div class="v1-w100 v1-index-choose-btn">
				重置密码
			</div>
			<div class="v1-w100 v1-index-choose-btn" id="send_captcha">
				手机号：
				<input name="mobile" id="mobile" style="width:156px;">
			</div>
			<div class="v1-w100 v1-index-choose-btn" id="verify_captcha">
				验证码：
				<input name="captcha" id="captcha" style="width:70px;">
				<button id="captcha-btn" class="btn btn-sm btn-default" data-loading-text="发送中..." autocomplete="off" onclick="javascript:resetpwd_commit_mobile('<?php echo base_url();?>')">获取验证码</button>
			</div>
			<div class="v1-w100 v1-index-choose-btn" id="reg-login">
				<a href="<?php echo base_url();?>login">返回登录 <span class="glyphicon glyphicon-info-sign"></span></a>
				<button class="v1-btn-brown" onclick="javascript:resetpwd_verify_mobile('<?php echo base_url();?>')">重置密码为手机号</button>
			</div>
		</div>
		<!-- 后面两个/div是因为v1_index_header前面有两个div对应的,为了全屏背景图-->
	</div>
</div>

<?php $this->load->view('v1_footer');?>