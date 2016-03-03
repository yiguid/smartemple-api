<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="row">
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="main row col-md-10">
	<h3>福位管理</h3>
	<div class="alert alert-info" role="alert">
		<a href="<?php echo base_url();?>master/space/add">新增</a>
	</div>
	<table class="table table-striped">
		<th>ID</th><th>位置</th><th>级别</th><th>价格</th><th>操作</th>
	<?php foreach($space as $s):?>  
		<tr>
		<?php echo "<td>".$s->id ."</td><td>".$s->location ."</td><td>".$s->class ."</td><td>".$s->price."</td>";?>
		<td><a href="space/id/<?php echo $s->id; ?>">查看</a>
		 | <a href="space/edit/<?php echo $s->id; ?>">编辑</a>
		 | <a href="space/delete/<?php echo $s->id; ?>" onclick="del_confirm()">删除</a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>