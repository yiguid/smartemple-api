<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
	<div class="container">
	<h3>智慧地宫</h3>
	<table class="table table-striped">
		<th>ID</th><th>寺院名称</th><th>地理位置</th><th>详细信息</th>
	<?php foreach($temple as $t):?>  
		<tr>
		<?php echo "<td>".$t->id ."</td><td>".$t->name ."</td><td>".$t->province.$t->city ."</td><td>".($t->scount!=null?$t->scount:0)."</td>";?>
		</tr>  
	<?php endforeach;?>  
	</table>
	<h3>智慧供养</h3>
	<table class="table table-striped">
		<th>ID</th><th>寺院名称</th><th>地理位置</th><th>详细信息</th>
	<?php foreach($temple as $t):?>  
		<tr>
		<?php echo "<td>".$t->id ."</td><td>".$t->name ."</td><td>".$t->province.$t->city ."</td><td>".($t->dcount!=null?$t->dcount:0)."</td>";?>
		</tr>  
	<?php endforeach;?>  
	</table>
</div>
<?php $this->load->view('footer');?>