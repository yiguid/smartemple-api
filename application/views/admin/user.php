<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>用户管理</h3>
	<div class="alert alert-info" role="alert">
		<a href="<?php echo base_url();?>admin/user/add">新增</a>
	</div>
	<table class="table table-striped">
		<th>ID</th><th>用户名</th><th>真实姓名</th><th>类型</th><th>寺院</th><th>注册时间</th><th>操作</th>
	<?php foreach($user as $u):?>  
		<tr>
		<?php echo "<td>".$u->id ."</td><td>".$u->username ."</td><td>".$u->realname ."</td><td>".$u->type."</td><td>".($u->templename == ''?'智慧寺院':$u->templename)."</td><td>".$u->registtime."</td>";?>
		<td>
		   <a href="user/edit/<?php echo $u->id; ?>">编辑</a>
		 | <a href="user/delete/<?php echo $u->id; ?>" onclick="del_confirm()">删除</a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>