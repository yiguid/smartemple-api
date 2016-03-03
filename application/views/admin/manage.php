<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>数据总览</h3>
	<div class="alert alert-info" role="alert">
		基本信息
	</div>
	<table class="table table-striped">
		<tr>
			<th>项目</th><th>用户数</th><th>寺院数</th>
			<th>地宫数</th><th>供养数</th><th>注册数</th>
		</tr>
		<tr>
			<td>数量</td><td><?php echo $user_num;?></td><td><?php echo $temple_num;?></td>
			<td><?php echo $space_num;?></td><td><?php echo $donation_num;?></td><td><?php echo $register_num;?></td>
		</tr>
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>