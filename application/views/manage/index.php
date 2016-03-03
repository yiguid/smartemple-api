<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('manage/header');
$this->load->view('manage/nav');
?>
<div class="row">
	<?php $this->load->view('slider');?>
</div>
<div class="row intro">
	<div class="intro-left fl">
		<div class="intro-item">
			<div class="intro-item-img fl">
				<img src="<?php echo base_url();?>assets/images/flower.png">
			</div>
			<div class="intro-item-content fl">
				<h3>什么是寺院智管平台？</h3>
				<p>智慧寺院是寺院综合事务的管理工具。被用户誉为寺院的智慧系统。</p>
			</div>
		</div>
		<div class="intro-item">
			<div class="intro-item-img fl">
				<img src="<?php echo base_url();?>assets/images/flower.png">
			</div>
			<div class="intro-item-content fl">
				<h3>寺院智管平台能做什么？</h3>
				<p>方丈可以用它给僧团、居士、志愿者安排工作，随时了解任务进度，掌控事务结果，提高寺院运行效率。</p>
			</div>
		</div>
		<div class="intro-item">
			<div class="intro-item-img fl">
				<img src="<?php echo base_url();?>assets/images/flower.png">
			</div>
			<div class="intro-item-content fl">
				<h3>为什么选择寺院智管平台？</h3>
				<p>随着寺院规模和影响力的扩大，筹集资金、信息发布、寺院事务管理，僧团、居士和志愿者间的管理事务愈发现代化，门类繁杂，人员众多，许多传统寺院每月需花大量时间在琐碎的管理事务上，无法集中精力潜心修行和弘法。寺院智管系统即为了解决这些问题而研发的。它针对性强，方便实施，简单易用，只需很好的投入就能在自己的局域网上实现网络化管理，让寺院管理事务条例更清晰。有效帮助方丈、住持和监院从繁琐的事务中解脱出来，集中更多精力进行佛教研究和弘法利生。</p>
			</div>
		</div>
		<div class="intro-item">
			<div class="intro-item-img fl">
				<img src="<?php echo base_url();?>assets/images/flower.png">
			</div>
			<div class="intro-item-content fl">
				<h3>谁在用寺院智管平台？</h3>
				<p>各大寺院可用来作为募集建设资金和扩大寺院影响力和日常管理的寺院智管平台。</p>
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
<div class="row wechat">
	<div class="wechat-left fl">
		<img src="<?php echo base_url();?>assets/images/weixin.png">
	</div>
	<div class="wechat-info fl">
		<h3>加入微信公众平台获取技术支持</h3>
		<p>用手机扫描右侧的二维码可以关注智慧寺院微信公众平台。</p>
		<p>通过微信公众平台可获得技术支持和升级消息，还可以获取寺院管理经验分享，了解相关资讯。</p>
	</div>
	<div class="wechat-qrcode fl">
		<img src="<?php echo base_url();?>assets/images/qrcode.png">
	</div>
</div>
<div class="row customer">
	<h5>谁在使用智慧寺院智管平台</h5>
	<ul>
		<li>古佛寺</li>
		<li>镇江寺</li>
		<li>圣竹林寺</li>
		<li>普光寺</li>
		<li>龙庆寺</li>
	</ul>
	<ul>
		<li>相国寺</li>
		<li>香山寺</li>
		<li>栖林寺</li>
		<li>资国寺</li>
		<li>乾明寺</li>
	</ul>
</div>
<?php $this->load->view('footer');?>