<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="main row">
<div class="container">
	<?php $this->load->view('crumb')?>
	<div class="list-group">
	<?php foreach ($volunteer_list as $volunteer) {?>
		<a href="<?php echo base_url()."volunteer/id/$temple->id/$volunteer->id";?>" class="list-group-item">
			<span class="badge"><?php echo $volunteer->inputtime;?></span>
			<?php echo $volunteer->title;?>
		</a>
	<?php }?>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>