<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="main row">
<div class="container">
	<?php $this->load->view('crumb')?>
	<div class="list-group">
	<?php foreach ($activity_list as $activity) {?>
		<a href="<?php echo base_url()."activity/id/$temple->id/$activity->id";?>" class="list-group-item">
			<span class="badge"><?php echo $activity->inputtime;?></span>
			<?php echo $activity->title;?>
		</a>
	<?php }?>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>