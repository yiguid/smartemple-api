<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="main row">
<div class="container">
	<?php $this->load->view('crumb')?>
	<div class="list-group">
	<?php foreach ($news_list as $news) {?>
		<a href="<?php echo base_url()."news/id/$temple->id/$news->id";?>" class="list-group-item">
			<span class="badge"><?php echo $news->inputtime;?></span>
			<?php echo $news->title;?>
		</a>
	<?php }?>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>