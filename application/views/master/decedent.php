<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="main row col-md-10">
	<h3>往生者管理</h3>
	<div class="alert alert-info" role="alert">
		<a href="#">新增</a>
	</div>
	<table class="table table-striped">
		<th>ID</th><th>真实姓名</th><th>性别</th><th>出生日期</th><th>往生日期</th><th>供养者</th><th>操作</th>
	<?php foreach($decedent as $d):?>  
		<tr>
		<?php echo "<td>".$d->id ."</td><td>".$d->realname ."</td><td>".$d->sex ."</td><td>".$d->birthday."</td><td>".$d->deathday."</td><td>".$d->providername."</td>";?>
		<td><a href="decedent?id=<?php echo $d->id; ?>">查看</a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
</div>
</div>
</div>

<?php $this->load->view('footer');?>