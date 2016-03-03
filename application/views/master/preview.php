<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
?>
<div class="row" id="xiujian">
<div class="container">
	<div class="syxj-title xj xj1">捐助寺院修建</div>
	<div class="xj-img xji1">
		<?php if($temple->planimg == null){?>
		<img src="<?php echo base_url();?>assets/images/xj1.jpg">
		<?php }else{?>
		<a target="_blank" href="<?php echo $temple->planlink;?>"><img src="<?php echo base_url($temple->planimg);?>"></a>
		<?php }?>
	</div>
</div>
<div class="xj-slogan">
	<small><a target="_blank" href="<?php echo $temple->planlink;?>">
		<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 查看寺院规划</a>
	</small>
	<span style="margin-left:20px;"></span>
	<small>
		<a href="#"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>
		观看寺院和住持简介</a>
	</small>
</div>
<div class="xj-back"></div>
</div>
<div class="row" id="fofaseng">
<div class="container">
	<div class="ffs-block">
		<div class="syxj-title xj">捐助建材</div>
		<div class="ffs-slogan">捐助建材无量功德，愿你平安吉祥！万事如意！</div>
		<?php
		$n=1;
		foreach ($jiancai as $jc) {?>
		<div class="ffs-item">
			<div class="ffs-item-img">
				<img src="<?php if($jc->img != null) echo base_url().$jc->img; else echo base_url()."assets/images/jc".$n.".jpg";?>">
				<div class="ffs-item-title"><?php echo $jc->name?></div>
			</div>
			<div class="ffs-item-des"><?php echo $jc->info?></div>
			<div class="ffs-item-price">￥<?php echo $jc->price?></div>
			<div class="ffs-item-buy">
				<a href="javascript:void(0)"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
				<input type="text" style="width:30px;text-align:center;" value="0" maxlength="4" name="soldcount<?php echo $jc->id?>" id="soldcount<?php echo $jc->id?>">
				<a href="javascript:void(0)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
		</div>
		<?php $n++;} 
		?>
	</div>
	<div class="ffs-block">
		<div class="syxj-title xj">捐助花木</div>
		<div class="ffs-slogan">捐助花木无量功德，愿你平安吉祥！万事如意！</div>
		<?php
		$n=1;
		foreach ($huamu as $hm) {?>
		<div class="ffs-item">
			<div class="ffs-item-img">
				<img src="<?php if($hm->img != null) echo base_url().$hm->img; else echo base_url()."assets/images/hm".$n.".jpg";?>">
				<div class="ffs-item-title"><?php echo $hm->name?></div>
			</div>
			<div class="ffs-item-des"><?php echo $hm->info?></div>
			<div class="ffs-item-price">￥<?php echo $hm->price?></div>
			<div class="ffs-item-buy">
				<a href="javascript:void(0)"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
				<input type="text" style="width:30px;text-align:center;" value="0" maxlength="4" name="soldcount<?php echo $hm->id?>" id="soldcount<?php echo $hm->id?>">
				<a href="javascript:void(0)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
		</div>
		<?php $n++;} 
		?>
	</div>
</div>
</div>
<?php $this->load->view('footer'); ?>