<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_index_header');
?>
			<div class="v1-index-choose">
				<div class="v1-w100"><div class="v1-index-choose-slogan">何来山深庙小 我有智慧寺院</div></div>
				<div class="v1-w100 v1-index-choose-btn">
					法师登录<p class="login-info"><?php if(isset($login_info)) echo $login_info;?></p>
				</div>
				<form action="<?php echo base_url();?>admin" method="post">
				<div class="v1-w100 v1-index-choose-btn">
					<input class="v1-no-background" type="text" size="20" placeholder="法号全拼，如gending" name="username" id="username"/>
				</div>
				<div class="v1-w100 v1-index-choose-btn">
					<input class="v1-no-background" type="password" size="20" placeholder="密码" name="password" id="password"/>
				</div>
				<div class="v1-w100 v1-index-choose-btn">
					<button type="submit" class="v1-btn-brown">登录</button>
				</div>
				<div class="v1-w100 v1-index-choose-btn">
					<a href="<?php echo base_url()."register"?>">新寺院登记 <span class="glyphicon glyphicon-info-sign"></span>
				</div>
				</form>
			</div>
		</div>
	</div>

<?php $this->load->view('alert_modal');?>
<?php $this->load->view('v1_footer');?>