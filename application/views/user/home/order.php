<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/home/home_nav');
?>
<div class="main row">
<div class="container">
	<h4>已完成的捐助</h4>
	<table class="table table-striped">
		<th>寺院</th><th>金额</th><th>状态</th><th>供养时间</th><th>详情</th>
	<?php foreach($order as $o):?>  
		<tr>
		<?php echo "<td>".$o->templename  ."</td><td>".$o->total;?>
		<td><?php echo $o->status."</td><td>".date('Y-m-d', strtotime($o->ordertime))."</td>";?></td>
		<td><a href="<?php echo base_url()."user/home/order/".$o->id?>">查看</a></td>
		</tr>
	<?php endforeach;?>  
	</table>
	<h4>参与的众筹项目</h4>
	<table class="table table-striped">
		<tr>
			<td>时间</td>
			<td>众筹项目</td>
			<td>捐赠资金</td>
			<td>奖励</td>
		</tr>
		<?php foreach($zhongchou as $z):?>  
		<tr>
			<td><?php echo $z->recordtime?></td>
			<td><?php echo $z->zhongchoutitle?></td>
			<td><?php echo $z->money?></td>
			<td><?php echo $z->award?></td>
		</tr>
		<?php endforeach;?>
	</table>
</div>
</div>
<?php $this->load->view('footer');?>