<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="row" id="xiujian">
<div class="container">
	<div class="syxj-title xj">捐助<?php echo $temple->name?>修建</div>
	<div class="xj-img xji1">
		<?php if($temple->planimg == null){?>
		<!-- <img src="<?php echo base_url();?>assets/images/xj1.jpg"> -->
		<img class="plan-img" style="display:none;" src="<?php echo base_url();?>assets/images/xj1.jpg">
		<img class="plan-img" style="display:none;" src="<?php echo base_url();?>assets/images/xj2.jpg">
		<img class="plan-img" style="display:none;" src="<?php echo base_url();?>assets/images/xj3.jpg">
		<img class="plan-img" src="<?php echo base_url();?>assets/images/xj4.jpg">
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
	<!-- <a style="font-size:6px;" href="<?php echo base_url()."visit";?>"><span class="glyphicon glyphicon-refresh"></span>返回地图</a> -->
</div>
<div class="xj-back"></div>
</div>
<div class="row">
	<div class="container" id="temple-wish">
		<marquee direction="up" scrollamount="1" width="100%" height="30px" onmouseover="this.stop()" onmouseout="this.start()" style="height: 30px; width: 100%;">
		<?php foreach ($wish as $w) {?>
		<div class="temple-wish-item">
			<a href="<?php echo base_url()."qf/temple/".$temple->id?>"><?php echo $w->location.$w->userid."：".$w->content?></a>
		</div>
		<?php }?>
		</marquee>
	</div>
</div>
<div class="row" id="fofaseng">
<div class="container">
	<div class="ffs-block">
		<div class="syxj-title xj xj4">捐助佛像</div>
		<div class="ffs-slogan">捐助佛像无量功德，愿你平安吉祥！万事如意！</div>
		<?php
		$n=1;
		foreach ($foxiang as $fx) {?>
		<div class="ffs-item">
			<div class="ffs-item-img">
				<a href="<?php echo base_url()."donation/item/".$temple->id."/".$fx->id?>"><img src="<?php if($fx->img != null) echo base_url().$fx->img; else echo base_url()."assets/images/fx".$n.".jpg";?>">
				<div class="ffs-item-title"><?php echo $fx->name?></div></a>
			</div>
			<div class="ffs-item-des"><a href="<?php echo base_url()."donation/item/".$temple->id."/".$fx->id?>"><?php echo $fx->info?></a></div>
			<div class="ffs-item-price"><?php if($fx->price >= 10000) echo ($fx->price/10000)."万"; else echo $fx->price;?>元</div>
			<div class="ffs-item-buy">
				<a href="javascript:cart_minus('<?php echo $fx->id;?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
				<input type="text" style="width:30px;text-align:center;" disabled="true" value="0" maxlength="4" name="soldcount<?php echo $fx->id?>" id="soldcount<?php echo $fx->id?>">
				<a href="javascript:cart_plus('<?php echo $fx->id?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success"
				 role="progressbar" style="width:<?php echo $fx->soldcount/$fx->amount*100;?>%;min-width:8.6em;"><?php echo $fx->soldcount." / ".$fx->amount;?></div>
			</div>
		</div>
		<?php $n++;} 
		?>
	</div>
	<div class="ffs-block">
		<div class="syxj-title xj xj3">捐助建材</div>
		<div class="ffs-slogan">捐助建材无量功德，愿你平安吉祥！万事如意！</div>
		<?php
		$n=1;
		foreach ($jiancai as $jc) {?>
		<div class="ffs-item">
			<div class="ffs-item-img">
				<a href="<?php echo base_url()."donation/item/".$temple->id."/".$jc->id?>">
					<img src="<?php if($jc->img != null) echo base_url().$jc->img; else echo base_url()."assets/images/jc".$n.".jpg";?>">
				<div class="ffs-item-title"><?php echo $jc->name?></div>
			</a>
			</div>
			<div class="ffs-item-des"><a href="<?php echo base_url()."donation/item/".$temple->id."/".$jc->id?>"><?php echo $jc->info?></a></div>
			<div class="ffs-item-price"><?php if($jc->price >= 10000) echo ($jc->price/10000)."万"; else echo $jc->price;?>元</div>
			<div class="ffs-item-buy">
				<a href="javascript:cart_minus('<?php echo $jc->id;?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
				<input type="text" style="width:30px;text-align:center;" disabled="true" value="0" maxlength="4" name="soldcount<?php echo $jc->id?>" id="soldcount<?php echo $jc->id?>">
				<a href="javascript:cart_plus('<?php echo $jc->id?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success"
				 role="progressbar" style="width:<?php echo $jc->soldcount/$jc->amount*100;?>%;min-width:8.6em;"><?php echo $jc->soldcount." / ".$jc->amount;?></div>
			</div>
		</div>
		<?php $n++;} 
		?>
	</div>
	<div class="ffs-block">
		<div class="syxj-title xj xj2">捐助设备</div>
		<div class="ffs-slogan">捐助设备无量功德，愿你平安吉祥！万事如意！</div>
		<?php
		$n=1;
		foreach ($shebei as $sb) {?>
		<div class="ffs-item">
			<div class="ffs-item-img">
				<a href="<?php echo base_url()."donation/item/".$temple->id."/".$sb->id?>">
					<img src="<?php if($sb->img != null) echo base_url().$sb->img; else echo base_url()."assets/images/sb".$n.".jpg";?>">
				<div class="ffs-item-title"><?php echo $sb->name?></div>
			</a>
			</div>
			<div class="ffs-item-des"><a href="<?php echo base_url()."donation/item/".$temple->id."/".$sb->id?>"><?php echo $sb->info?></a></div>
			<div class="ffs-item-price"><?php if($sb->price >= 10000) echo ($sb->price/10000)."万"; else echo $sb->price;?>元</div>
			<div class="ffs-item-buy">
				<a href="javascript:cart_minus('<?php echo $sb->id;?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
				<input type="text" style="width:30px;text-align:center;" disabled="true" value="0" maxlength="4" name="soldcount<?php echo $sb->id?>" id="soldcount<?php echo $sb->id?>">
				<a href="javascript:cart_plus('<?php echo $sb->id?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success"
				 role="progressbar" style="width:<?php echo $sb->soldcount/$sb->amount*100;?>%;min-width:8.6em;"><?php echo $sb->soldcount." / ".$sb->amount;?></div>
			</div>
		</div>
		<?php $n++;} 
		?>
	</div>
	<div class="ffs-block">
		<div class="syxj-title xj xj1">捐助花木</div>
		<div class="ffs-slogan">捐助花木无量功德，愿你平安吉祥！万事如意！</div>
		<?php
		$n=1;
		foreach ($huamu as $hm) {?>
		<div class="ffs-item">
			<div class="ffs-item-img">
				<a href="<?php echo base_url()."donation/item/".$temple->id."/".$hm->id?>">
					<img src="<?php if($hm->img != null) echo base_url().$hm->img; else echo base_url()."assets/images/hm".$n.".jpg";?>">
				<div class="ffs-item-title"><?php echo $hm->name?></div>
				</a>
			</div>
			<div class="ffs-item-des"><a href="<?php echo base_url()."donation/item/".$temple->id."/".$hm->id?>"><?php echo $hm->info?></a></div>
			<div class="ffs-item-price"><?php if($hm->price >= 10000) echo ($hm->price/10000)."万"; else echo $hm->price;?>元</div>
			<div class="ffs-item-buy">
				<a href="javascript:cart_minus('<?php echo $hm->id;?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
				<input type="text" style="width:30px;text-align:center;" disabled="true" value="0" maxlength="4" name="soldcount<?php echo $hm->id?>" id="soldcount<?php echo $hm->id?>">
				<a href="javascript:cart_plus('<?php echo $hm->id?>','<?php echo base_url();?>')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-warning"
				 role="progressbar" style="width:<?php echo $hm->soldcount/$hm->amount*100;?>%;min-width:8.6em;"><?php echo $hm->soldcount." / ".$hm->amount;?></div>
			</div>
		</div>
		<?php $n++;} 
		?>
	</div>
	<div class="ffs-block">
		<div class="syxj-title xj xj1"><a style="color:white;text-decoration:none;" href="<?php echo base_url().'temple/shida/'.$temple->id;?>">十大供养</a></div>
		<div class="ffs-slogan"><p>点击查看什么是佛前十大供养</p></div>
	</div>
	<div class="ffs-block">
		<div class="syxj-title xj xj4">捐助方式</div>
		<div class="ffs-slogan"><p>您可以在线选择物品供养或者到寺院完成供养。</p><?php echo $temple->contacts;?></div>
	</div>
</div>
</div>

<?php $this->load->view('temple/global_checkout'); ?>
<?php $this->load->view('footer'); ?>
<script type="text/javascript">
var cur = 0;
function switch_plan_img(){
	var i = 0;
	$('.plan-img').each(function(){
		if(i == cur)
			$(this).fadeIn(1000);
		else
			$(this).hide();
		i++;
	});
	cur++;
	if(cur == 3)
		cur = 0;
}
var plan_img = setInterval("switch_plan_img()",4000);
</script>