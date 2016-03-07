<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>
<div class="row" style="border-top:2px solid #938561;">

	<div class="container">
		<!-- <div>

		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">按地区</a></li>
		    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">按法号</a></li>
		    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">按寺院</a></li>
		  </ul>

		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="home">地区</div>
		    <div role="tabpanel" class="tab-pane" id="profile">法号</div>
		    <div role="tabpanel" class="tab-pane" id="messages">寺院</div>
		  </div>

		</div> -->
		<div>
		<h5 class="text-center">每日语音开示：智慧分享与有缘众生<small> - 点击法师头像收听</small></h5>
		<?php $num=1;foreach ($master_voice_list as $master) {?>
			<a href="<?php echo base_url()."voice/temple/".$master->templeid;?>">
			<div class="v1-fl v1-w10 v1-rec-master">
				<div class="v1-rec-master-img">
					<img src="<?php echo base_url().($master->avatar == ''?"assets/images/fashi-small.jpg":$master->avatar)?>" />
				</div>
				<div class="v1-rec-master-name">
					<?php echo $master->realname?><br/>
					<span class="glyphicon glyphicon-heart"></span> <?php echo $master->views?>
				</div>	
			</div>
			</a>
		<?php $num++;}?>
		<div style="clear:both;"></div>
		</div>
		<br/>
		<div>
		<h5 class="text-center">众生皆具如来智慧德相 自性回归证生命大自在</h5>
		<?php $num=1;foreach ($master_list as $master) {?>
			<a href="<?php echo base_url()."user/master/id/".$master->id;?>">
			<div class="v1-fl v1-w10 v1-rec-master">
				<div class="v1-rec-master-img">
					<img src="<?php echo base_url().($master->avatar == ''?"assets/images/fashi-small.jpg":$master->avatar)?>" />
				</div>
				<div class="v1-rec-master-name">
					<?php echo $master->realname?><br/>
					<span class="glyphicon glyphicon-heart"></span> <?php echo $master->views?>
				</div>	
			</div>
			</a>
		<?php $num++;}?>
		</div>
	</div>
</div>

<?php $this->load->view('wxshare_tail');?>
<?php $this->load->view('v1_footer');?>