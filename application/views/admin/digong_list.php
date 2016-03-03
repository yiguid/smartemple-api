<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="main row">
	<div class="container">
	<?php $this->load->view('crumb')?>
	<div class="alert alert-info" role="alert">
		<h3><?php echo $temple->name?> - <small>已供奉3948个福位，总价值320万元。</small></h3>
	</div>
	<table class="table table-striped">
		<th>类型</th><th>形式</th><th>详细信息</th><th>单价</th><th>操作</th>
	<?php foreach($space as $s):?>  
		<tr>
		<?php echo "<td>".$s->location ."</td><td>".$s->class ."</td><td>".$s->intro ."</td><td>".$s->price."</td>";?>
		<td><a href="<?php echo base_url()."admin/digong/space/".$s->id; ?>">查看</a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
	</div>
</div>
<?php $this->load->view('footer');?>