<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">		
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<div class="alert alert-info" role="alert">
		<h3><?php echo $temple->name?> - <small>
			<?php echo "已有供养".$donation_info->count."项，金额".round($donation_info->income,2)?>元。
			<a href="javascript:alert('功能完善中')" class="btn btn-primary" role="button">提取善款</a>
		</small></h3>
		<a href="<?php echo base_url();?>master/donation/step1" class="btn btn-primary btn-sm" role="button">手动登记供养</a>
	</div>
	<table class="table table-striped">
		<th>供养时间</th><th>供养人</th><th>金额</th><th>状态</th><th>详情</th>
	<?php foreach($order as $o):?>  
		<tr>
		<td><?php echo $o->ordertime ."</td><td>".($o->contact != '0'?$o->contact:'匿名') ."</td><td>".$o->total."</td>";?>
		<td><?php echo $o->status; ?></td>
		<?php echo "<td><a href=\"".base_url()."master/donation/order/".$o->id."\">查看</a></td>"?>
		</tr>  
	<?php endforeach;?>
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>