<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('manage/header');
$this->load->view('manage/nav');
?>
<div class="row intro">
	<div class="intro-left fl">
		<div class="intro-item">
			<div class="intro-item-content fl">
				<h3>北京洛克威尔咨询股份有限公司</h3>
				<p>Beijing Rockwill Consultancy</p>
			</div>
		</div>
		<div class="intro-item">
			<div class="intro-item-content fl">
				<h3>地址：北京市海淀区公主坟国海大厦D座</h3>
				<p>Address：Building D. Guohai Plaza, Gongzhufen, Haidian, Beijing</p>
			</div>
		</div>
		<div class="intro-item">
			<div class="intro-item-content fl">
				<h3>联系电话：010-53667513，18518753260</h3>
				<p>Tel：010-53667513，18518753260</p>
			</div>
		</div>
		<div class="intro-item">
			<div class="intro-item-content fl">
				<h3>官方网站：http://www.irockwill.com</h3>
				<p>Email：info@irockwill.com</p>
			</div>
		</div>
	</div>
	<div class="intro-right rt">
		<img src="<?php echo base_url();?>assets/images/ipad.png">
	</div>
</div>
<div class="row slogan">
	<p class="text-center">不需要自己部署服务器，不需要购买软件授权，基于阿里云平台，开通就能用。只需用邮箱登记就可以立即开通！</p>
</div>
<?php $this->load->view('footer');?>