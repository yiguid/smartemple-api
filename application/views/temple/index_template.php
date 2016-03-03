<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
?>
<div class="slider row">
	<div class="main container">
		<div class="info">
			<div class="text-right">
				<h3><?php echo $temple->name?></h3>
			</div>
		</div>
		<div class="slider-slogan">智慧供养<br/>
			<small>心 动 行 动 间</small><br/>
			<small>
				<a href="#"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>
				观看寺院和住持简介</a>
			</small>
		</div>
	</div>
	<div class="slider-back"></div>
</div>
<div class="slogan text-center row">
<div class="container">
	佛告诉毗耶娑，有人虽做了好事，但挟带了功利性的不清净心理，不算真布施。<br/>——佛说三十三种不清净布施
</div>
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
<div class="row" id="xiujian">
<div class="container">
	<div class="syxj-title">供养寺院修建</div>
	<div class="syxj-title xj xj1">供养建材</div>
	<div class="xj-img xji1">
		<img src="<?php echo base_url();?>assets/images/xj1.jpg">
	</div>
	<div class="syxj-title xj xj2">供养佛像</div>
	<div class="xj-img xji2">
		<img src="<?php echo base_url();?>assets/images/xj2.jpg">
	</div>
	<div class="syxj-title xj xj3">供养花木</div>
	<div class="xj-img xji3">
		<img src="<?php echo base_url();?>assets/images/xj3.jpg">
	</div>
	<div class="syxj-title xj xj4">供养其他</div>
	<div class="xj-img xji4">
		<img src="<?php echo base_url();?>assets/images/xj4.jpg">
	</div>
</div>
</div>
<div class="row" id="fofaseng">
<div class="container">
	<div class="ffs-title">供养佛法僧</div>
	<div class="ffs-block">
		<div class="ffs-block-title">供养佛</div>
		<div class="ffs-slogan">供养佛无量功德，愿你平安吉祥！万事如意！</div>
		<?php
		$n=1;
		foreach ($gongyangfo as $gyf) {?>
		<div class="ffs-item">
			<div class="ffs-item-img">
				<img src="<?php echo base_url();?>assets/images/ffs<?php echo $n;?>.png">
				<div class="ffs-item-title"><?php echo $gyf->name?></div>
			</div>
			<div class="ffs-item-des"><?php echo $gyf->info?></div>
			<div class="ffs-item-price">￥<?php echo $gyf->price?></div>
			<div class="ffs-item-buy">
				<a href="javascript:cart_minus('<?php echo $gyf->id;?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
				<input type="text" style="width:30px;text-align:center;" value="0" maxlength="4" name="soldcount<?php echo $gyf->id?>" id="soldcount<?php echo $gyf->id?>">
				<a href="javascript:cart_plus('<?php echo $gyf->id?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
		</div>
		<?php $n++;} 
		?>
	</div>
	<div class="ffs-block">
		<div class="ffs-block-title">供养法</div>
		<div class="ffs-slogan">供养佛无量功德，愿你平安吉祥！万事如意！</div>
		<?php
		$n=1;
		foreach ($gongyangfa as $gyfa) {?>
		<div class="ffs-item">
			<div class="ffs-item-img">
				<img src="<?php echo base_url();?>assets/images/gyfa<?php echo $n;?>.png">
				<div class="ffs-item-title"><?php echo $gyfa->name?></div>
			</div>
			<div class="ffs-item-des"><?php echo $gyfa->info?></div>
			<div class="ffs-item-price">￥<?php echo $gyfa->price?></div>
			<div class="ffs-item-buy">
				<a href="javascript:cart_minus('<?php echo $gyfa->id;?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
				<input type="text" style="width:30px;text-align:center;" value="0" maxlength="4" name="soldcount<?php echo $gyfa->id?>" id="soldcount<?php echo $gyfa->id?>">
				<a href="javascript:cart_plus('<?php echo $gyfa->id?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
		</div>
		<?php $n++;} 
		?>
	</div>
</div>
</div>

<?php $this->load->view('temple/global_checkout'); ?>

<div class="row" id="aide">
<div class="container">
	<div class="adjh-title">爱的供养计划</div>
	<?php
	$n = 1;
	foreach ($aidegongyang as $aide) {?>
		<div class="adjh jh<?php echo $n;?>">
			<a href="javascript:cart_add('<?php echo $aide->id;?>','<?php echo base_url();?>')">
				<div class="sold-info" id="sold-info<?php echo $aide->id;?>">功德无量</div>
				<?php echo $aide->name;?>
				<div class="adjh-info"><?php echo $aide->price;?>元每次</div>
			</a>
		</div>
	<?php 
	$n++;
	} ?>
</div>
</div>
<?php $this->load->view('footer'); ?>