<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/user_nav');
?>
<div class="main row">
<div class="container">
	<div class="alert alert-info" role="alert">
		<h3>我的主页</h3>
	</div>
	<div class="list-group">
	<?php foreach ($news_list as $news) {?>
		<a target="_blank" href="<?php echo base_url()."news/id/$news->templeid/$news->id";?>" class="list-group-item">
			<span class="badge"><?php echo $news->inputtime;?></span>
			<?php echo "[".$news->templename."] ".$news->title;?>
		</a>
	<?php }?>
	</div>
	<div class="alert alert-info" role="alert">
		<h3>活动</h3>
	</div>
	<div class="list-group">
	<?php foreach ($activity_list as $activity) {?>
		<a target="_blank" href="<?php echo base_url()."activity/id/$activity->hostid/$activity->id";?>" 
			class="list-group-item">
			<span class="badge"><?php echo $activity->inputtime;?></span>
			<?php echo "[".$activity->templename."] ".$activity->title;?>
		</a>
	<?php }?>
	</div>
	<div class="alert alert-info" role="alert">
		<h3>祈福开示</h3>
	</div>
	<div class="list-group">
	<?php foreach ($qf_list as $qf) {?>
		<a target="_blank" href="<?php echo base_url()."qf/temple/$qf->templeid";?>" 
			class="list-group-item">
			<span class="badge"><?php echo $qf->datetime;?></span>
			<?php echo "[".$qf->templename."] ".$qf->content;?>
		</a>
	<?php }?>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>