<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">
	<div class="container">
	<div class="alert alert-danger">
		<a class="btn btn-danger" 
		href=<?php echo base_url()."admin/qf/recent";?>>查看最新祈福</a>
	</div>
	<?php foreach($temple as $t):?>  
		<div class="alert alert-danger card" role="alert">
		<h3><?php echo $t->name;?><small> - <?php echo $t->province." ".$t->city;?></small></h3>
		<h5><a href=<?php echo base_url()."qf/temple/".$t->id;?>>开始祈福</a></h5>
		</div>
	<?php endforeach;?>  
	</div>
</div>
<?php $this->load->view('footer');?>