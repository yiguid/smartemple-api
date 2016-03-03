<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<table class="table table-striped">
		<th>供养编号</th>
		<tr>
		<?php echo "<td>".$order->id ."</td>";?>
		</tr>  
	</table>
	<table class="table table-striped">
		<th>供养时间</th><th>供养人</th><th>金额</th><th>状态</th>
		<tr>
		<?php echo "<td>".$order->ordertime ."</td><td>".$order->contact ."</td><td>".$order->total ."</td><td>".$order->status."</td>";?>
		</tr>  
	</table>
	<table class="table table-striped">
		<th>供养物品</th><th>供养数量</th><th>详细信息</th><th>单价</th>
		<?php foreach($order_items as $item):?>  
		<tr>
		<?php echo "<td>".$item->name ."</td><td>".$item->count ."</td><td>".$item->info ."</td><td>".$item->price."</td>";?>
		</tr>  
		<?php endforeach;?>  
	</table>
	<span class="rt">
		<?php if($order->status == '未支付'){?>
		<a class="btn btn-danger" onclick="javascript:del_confirm()"
			href="<?php echo base_url()."master/donation/delete_order/".$order->id?>">
			删除</a>
		<a class="btn btn-success" onclick="javascript:cashpay_confirm()"
			href="<?php echo base_url()."master/donation/cashpay_order/".$order->id?>">
			现场支付</a>
		<?php }?>
		<a class="btn btn-default" href="<?php echo base_url()."master/donation"?>">返回</a>
	</span>
</div>
</div>
</div>
<?php $this->load->view('footer');?>