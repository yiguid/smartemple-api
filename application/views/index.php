<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
?>
<div class="slider row">
	<div class="main container">
		<div class="info">
		</div>
		<div class="slider-slogan">心 动 行 动 间<br/>
			<div class="index-block">
				<a class="btn btn-info" href="<?php echo base_url('admin');?>">
					我是法师
				</a>
			</div>
			<div class="index-block">
			<a class="btn btn-info" href="<?php echo base_url('user');?>">
				我是居士
			</a></div>
			<div class="index-block">
			<a class="btn btn-info" href="javascript:show_alert('功能开发中','敬请期待...')">
				我是企业
			</a></div>
		</div>
	</div>
	<div class="slider-back"></div>
</div>
<div class="slogan text-center row">
<div class="container">
	<p>智慧寺院理念帮助寺院将传统的弘扬佛法，登记供养，祈福开示，义工禅修等佛事活动迁移到云端<br/>实现手机app，微信，网站无缝连接。</p>
</div>
</div>
<?php $this->load->view('alert_modal');?>
<?php $this->load->view('footer');?>