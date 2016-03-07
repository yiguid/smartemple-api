<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/home/home_nav');
?>
<div class="main row">
<div class="container">
	<h4>已报名的活动</h4>
	<div class="v1-list-group">
	<?php foreach ($activity_list as $activity) {?>
		<a href="<?php echo base_url()."user/activity/id/$activity->id";?>" 
			class="v1-list-group-item">
			<div class="v1-list-news-item">
			<div class="v1-list-news-templename"><?php echo "[".($activity->templename!=''?$activity->templename:'智慧寺院网')."]";?></div>
			<div class="v1-list-news-title"><?php echo $activity->title;?></div>
			<div class="v1-list-news-date"><?php echo date('Y-m-d', strtotime($activity->registertime));?></div>
			</div>
		</a>
	<?php }?>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>