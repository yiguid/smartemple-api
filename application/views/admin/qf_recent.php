<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">
	<div class="container">
	<div class="col-md-12">
	<table class="table table-striped">
		<th>寺院</th><th>用户</th><th>时间</th><th>位置</th><th>操作</th>
	<?php foreach($qf as $q):?>  
		<tr>
		<?php echo "<td>".$q->templename ."</td><td>".$q->userid ."</td><td>".$q->datetime."</td><td>".$q->location."</td>";?>
		<td><a href="<?php echo base_url();?>admin/qf/delete/<?php echo $q->id; ?>" onclick="del_confirm()">删除</a></td>
		</tr>
		<tr><td class="danger" colspan="5"><?php echo '祈福内容：'.$q->content;?></td></tr>
	<?php endforeach;?>  
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>