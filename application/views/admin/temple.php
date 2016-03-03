<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>寺院管理</h3>
	<div class="alert alert-info" role="alert">
		<a href="<?php echo base_url();?>admin/temple/add">新增</a>
		<?php if(isset($delete_temple_info)) echo "<p class=\"alert alert-danger\">".$delete_temple_info."</p>";?>
	</div>
	<table class="table table-striped">
		<th>ID</th><th>寺院名</th><th>置顶</th><th>位置</th><th>住持</th><th>操作</th>
	<?php foreach($temple as $t):?>  
		<tr>
		<?php echo "<td>".$t->id ."</td><td>".$t->name ."</td><td>"
		."<a class=\"btn btn-".($t->pos==0?'primary':'danger')."\" href=\"".base_url()."admin/temple/stick/".$t->id."/$t->pos\">".($t->pos==0?'普通':'置顶')."</a>"
		."</td><td>".$t->province." ".$t->city."</td><td>".$t->master."</td>";?>
		<td><a href="<?php echo base_url();?>admin/temple/id/<?php echo $t->id; ?>">查看</a>
		 | <a href="<?php echo base_url();?>admin/temple/edit/<?php echo $t->id; ?>">编辑</a>
		 | <a href="<?php echo base_url();?>admin/temple/delete/<?php echo $t->id; ?>" onclick="del_confirm()">删除</a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>