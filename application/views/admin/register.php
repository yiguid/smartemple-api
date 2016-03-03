<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>注册管理</h3>
	<table class="table table-striped">
		<th>ID</th><th>联系人</th><th>联系电话</th><th>寺院名称</th><th>登记时间</th>
	<?php foreach($register as $r):?>  
		<tr>
		<?php echo "<td>".$r->id ."</td><td>".$r->username ."</td><td>".$r->mobile ."</td><td>".$r->temple."</td><td>".$r->registertime."</td>";?>
		</tr>  
	<?php endforeach;?>  
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>