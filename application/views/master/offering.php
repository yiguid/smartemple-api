<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="main row col-md-10">
	<h3>供养管理</h3>
	<div class="alert alert-info" role="alert">
		<a href="#">新增</a>
	</div>
	<table class="table table-striped">
		<th>ID</th><th>供养者</th><th>往生者</th><th>福位</th><th>操作</th>
	<?php foreach($offering as $o):?>  
		<tr>
		<?php echo "<td>".$o->id ."</td><td>".$o->providername ."</td><td>".$o->decedentname ."</td><td>".$o->location."</td>";?>
		<td><a href="offering?id=<?php echo $o->id; ?>">查看</a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>