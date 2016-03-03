<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="main row">
	<div class="container">
	<?php $this->load->view('crumb')?>
	<?php foreach($temple as $t):?>  
		<div class="alert alert-info card" role="alert">
		<h3><?php echo $t->name;?><small> - <?php echo $t->province." ".$t->city;?></small></h3>
		<?php echo "拥有地宫福位数量：".($t->scount!=null?$t->scount:0);?>
		<h5><a href=<?php echo base_url()."admin/digong/temple/".$t->id;?>>查看详情</a></h5>
		</div>
	<?php endforeach;?>  
	</div>
</div>
<?php $this->load->view('footer');?>