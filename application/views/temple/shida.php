<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/visit.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/temple.css">
<div class="row" id="xiujian">
<div class="container">
	<div class="syxj-title xj">捐助<?php echo $temple->name?>修建</div>
	<div class="xj-img xji1">
		<?php if($temple->planimg == null){?>
		<img src="<?php echo base_url();?>assets/images/xj1.jpg">
		<?php }else{?>
		<a target="_blank" href="<?php echo $temple->planlink;?>"><img src="<?php echo base_url($temple->planimg);?>"></a>
		<?php }?>
	</div>
</div>
<div class="xj-slogan">
	<small><a target="_blank" 
		href="<?php if(isset($temple->planlink)) echo $temple->planlink; else echo base_url('plan');?>">
		<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 查看<?php echo $temple->name?>规划</a>
	</small>
	<span style="margin-left:20px;"></span>
	<small>
		<a target="_blank" href="<?php if(isset($temple->intro)) echo $temple->intro; else echo base_url('plan');?>"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>
		观看<?php echo $temple->name?>和住持简介</a>
	</small>
	<span style="margin-left:20px;"></span>
	
</div>
<div class="xj-back"></div>
</div>
<!-- 十大 -->
<div class="row" id="shida">
<div class="container" id="shida-content">
	<div class="shida-title-lg">佛的十大供养</div>
	<div class="shida-intro"><p>每点击一次图标代表供养一元</p><p>阿弥陀佛！功德无量！</p></div>
	<div class="center-img" id="ci1"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/flower-lg.png"/></a></div>
	<div class="center-img" id="ci2"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/flower-lg-red.png"/></a></div>
	<div id="center-title">佛的十大供养</div>
	<?php
	$n = 1;
	foreach ($shidagongyang as $shida) {?>
		<div id="shida<?php echo $n;?>">
		<div class="shida-img" id="shida-img<?php echo $n;?>">
			<div class="sold-info" id="sold-info<?php echo $shida->id;?>">功德无量</div>
			<a href="javascript:cart_add('<?php echo $shida->id;?>','<?php echo base_url();?>')"><img src="<?php echo base_url();?>assets/images/shida<?php echo $n;?>.png" class="img-circle"></a>
		</div>
		<div class="shida-title" id="shida-title<?php echo $n;?>"><?php echo $shida->name;?></div>
		<div class="shida-content" id="shida-content<?php echo $n;?>"><?php echo $shida->info;?></div>
		</div>
	<?php 
	$n++;
	} ?>
</div>
</div>
<?php $this->load->view('footer'); ?>