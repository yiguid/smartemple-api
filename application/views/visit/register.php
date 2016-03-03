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
				注册账号
				<a href="<?php echo base_url();?>login">已有账号登录 <span class="glyphicon glyphicon-info-sign"></span></a>
				<div class="wifi-info-input" id="send_captcha">
					手机号：
					<input name="mobile" id="mobile" style="width:156px;">
				</div>
				<div class="wifi-info-input" id="verify_captcha">
					验证码：
					<input name="captcha" id="captcha" style="width:70px;">
					<button id="captcha-btn" class="btn btn-sm btn-default" data-loading-text="发送中..." autocomplete="off" onclick="javascript:commit_mobile('<?php echo base_url();?>')">获取验证码</button>
				</div>
				<div class="wifi-info-input" id="reg-login">
					<button class="btn btn-sm btn-success btn-block" onclick="javascript:verify_mobile('<?php echo base_url();?>')">注 册</button>
				</div>
			</div>
		</div>
		<div class="slider-slogan">心 动 行 动 间<br/>
			<!-- <small><a target="_blank" href="<?php if(isset($temple->planlink)) echo $temple->planlink; else echo base_url('plan');?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
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
	佛告诉毗耶娑，有人虽做了好事，但挟带了功利性的不清净心理，不算真布施。<br/>——佛说三十三种不清净布施
</div>
</div>

<?php $this->load->view('footer');?>