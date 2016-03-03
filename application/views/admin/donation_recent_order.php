<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">
	<div class="container">
	<table class="table table-striped">
		<th>供养时间</th><th>供养人</th><th>金额</th><th>状态</th><th>寺院</th>
	<?php foreach($recent_order as $o):?>  
		<tr>
		<td><?php echo $o->ordertime ."</td><td>".($o->contact != '0'?$o->contact:'匿名') ."</td><td>".$o->total."</td>";?>
		<td><?php echo $o->status; ?></td>
		<?php echo "<td>".$o->templename."</td>"?>
		</tr>  
	<?php endforeach;?>
	</table>
</div>
</div>
<?php $this->load->view('footer');?>