<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/home/home_nav');
?>
<div class="main row">
<div class="container">
	<div class="shide">
		<h2>十德</h2>
		<p>消灭怨结，断除业障。天人护佑，逢凶化吉。</p><p>去除障碍，免夙怨苦。妖魔邪怪，不能侵犯。</p>
		<p>脱离烦恼，破除无明。丰衣足食，福禄绵长。</p><p>所言所行，人天欢喜。福慧二资，俱得增长。</p>
		<p>往生善道，相貌端庄。往生佛国，速证佛果。</p>
		<h2>五利</h2>
		<p>身相端庄 气力增盛 寿命延长 快乐安稳 成就辩才</p>
	</div>
	<table class="table table-striped">
		<th>供养编号： <?php echo $order->id;?></th>
	</table>
	<table class="table table-striped">
		<th>供养时间</th><th>金额</th><th>状态</th>
		<tr>
		<?php echo "<td>".$order->ordertime ."</td><td>".$order->total ."</td><td>".$order->status."</td>";?>
		</tr>  
	</table>
	<table class="table table-striped">
		<th>物品</th><th>数量</th><th>详细信息</th><th>单价</th>
		<?php foreach($order_items as $item):?>  
		<tr>
		<?php echo "<td>".$item->name ."</td><td>".$item->count ."</td><td>".$item->info ."</td><td>".$item->price."</td>";?>
		</tr>  
		<?php endforeach;?>  
	</table>
	
	<span class="rt">
	<?php if($order->status == '未支付'){ ?>
		<a href="<?php echo base_url()."alipay/pay/".$order->id;?>" class="btn btn-success">继续支付</a>
	<?php }?>
	<a class="btn btn-default" href="<?php echo base_url()."user/order"?>">返回</a>
	</span>
</div>
</div>
<?php $this->load->view('footer');?>