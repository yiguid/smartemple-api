<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<div class="row col-md-12">
	<h3>祈福管理 <small><a class="btn btn-danger btn-xs" href="<?php echo base_url().'qf/temple/'.$this->session->userdata('templeid');?>">查看祈福墙</a></small></h3>
	<table class="table table-striped">
		<th>ID</th><th>用户</th><th>内容</th><th>时间</th><th>位置</th><th>操作</th>
	<?php foreach($qf as $q):?>  
		<tr>
		<?php echo "<td>".$q->id ."</td><td>".$q->userid ."</td><td>".$q->content ."</td><td>".$q->datetime."</td><td>".$q->location."</td>";?>
		<td><a href="qf/delete/<?php echo $q->id; ?>" onclick="del_confirm()">删除</a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>