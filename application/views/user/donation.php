<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>
<div class="row" style="border-top:2px solid #938561;">
	<div class="container">
		<div class="v1-fl v1-w50">
			<div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
		      <div class="carousel-inner" role="listbox">
		      	<?php $num = 1; foreach ($zhongchou_list as $zhongchou) {
		      		if($num == 1){?>
		      			<div class="item active">
			      		<?php }else{ ?>
			      		<div class="item">
			      		<?php } ?>
				        	<a href="<?php echo base_url('user/zhongchou/id')."/".$zhongchou->id;?>">
				          	<img src="<?php if($zhongchou->img != '') echo base_url().$zhongchou->img; else echo base_url('assets/images/donation2.jpg');?>" width="100%">
				         	<div class="carousel-caption">
				            	<h3><?php echo $zhongchou->title;?></h3>
				            	<p><?php echo $zhongchou->description;?></p>
				          	</div>
				          	</a>
		        	    </div>
		      	<?php $num++;
		      		if($num == 4)
		      			break;
		      	}?>
		        <!-- 
		      	</div> -->
			      <a class="left carousel-control" href="#carousel-example-captions" role="button" data-slide="prev">
			        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			        <span class="sr-only">Previous</span>
			      </a>
			      <a class="right carousel-control" href="#carousel-example-captions" role="button" data-slide="next">
			        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			        <span class="sr-only">Next</span>
			      </a>
		    	<!-- </div> -->
			  </div>
			</div>
		</div>
		<div class="v1-fl v1-w50">
			<a href="<?php echo base_url()."user/donation/roll";?>" class="v1-list-group-item">
					<div class="v1-list-news-item">
					<div class="v1-list-news-title" style="width:100%;color:#AE0000;text-align:center;font-size:18px;font-weight:bold;">功德榜</div>
					</div>
				</a>
			<?php $num=0; foreach ($roll_list as $roll) {?>
				<a href="<?php echo base_url()."temple/id/$roll->templeid";?>" class="v1-list-group-item">
					<div class="v1-list-news-item">
					<div class="v1-list-news-templename"><?php echo "[".($roll->templename!=''?$roll->templename:'智慧寺院网')."]";?></div>
					<div class="v1-list-news-title" style="width:45%;"><?php echo $roll->contact.'捐助'.$roll->total.'元';?></div>
					<div class="v1-list-news-date"><?php echo date('Y-m-d', strtotime($roll->ordertime));?></div>
					</div>
				</a>
			<?php $num++;if($num == 7) break;}?>
		</div>
	</div>
</div>

<div class="row">
<div class="container">
	<?php 
	$num = 1;
	foreach ($zhongchou_list as $zhongchou) {
		$num++;
		if($num < 5)
			continue;
	?>
	<a href="<?php echo base_url().'user/zhongchou/id/'.$zhongchou->id?>">
	<div class="v1-w50 v1-donation-item-list">
		<div class="v1-donation-item-img">
			<img src="<?php 
			if($zhongchou->img != '')
				echo base_url().$zhongchou->img;
			else
				echo base_url().'assets/images/xj'.rand(1,3).'.jpg';
			?>" class="img-responsive" ></div>
		<div class="v1-donation-item-title"><?php echo mb_substr($zhongchou->title,0,18)?></div>
		<div class="v1-donation-item-content"><?php echo $zhongchou->description;?></div>
		<div class="v1-donation-item-statistics">已有<span><?php echo $zhongchou->views?></span>人关注</div>
	</div>
	</a>
	<?php }?>
</div>
</div>
<?php $this->load->view('v1_footer');?>