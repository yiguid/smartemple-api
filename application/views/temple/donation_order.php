<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="order row">
<div class="container">
	<div class="order-alert alert alert-info" role="alert">
		<?php echo $temple->name?>感谢您的护持与供养！<br/>阿弥陀佛！功德无量！
	</div>
	<table class="table table-striped">
		<th>名称</th><th>单价</th><th>数量</th><th>小计</th><th>删除</th>
		<?php foreach($this->cart->contents() as $items):?>  
			<tr id="tr<?php echo $items['id']?>">
			<?php echo "<td>".$items['name'] ."</td><td>￥".$items['price']?>
			</td><td>
				<a href="javascript:order_minus('<?php echo $items['id'];?>','<?php echo base_url();?>')">
				<span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
				<input type="text" style="width:30px;text-align:center;" disabled="true" value="<?php echo $items['qty']?>" maxlength="4"
				 name="soldcount<?php echo $items['id']?>" id="soldcount<?php echo $items['id']?>">
				<a href="javascript:order_plus('<?php echo $items['id']?>','<?php echo base_url();?>')">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</td>
			<td>￥<?php echo $items['subtotal']?>
			</td><td>
			<a href="javascript:order_remove('<?php echo $items['id'];?>','<?php echo base_url();?>')">
				<span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>  
		<?php endforeach;?>
	</table>
	<span class="rt">
	<div class="order-info">供养
		<?php echo $this->cart->total_items();?>个物品，总计
		<?php 
			if($this->cart->total() >= 10000)
				echo $this->cart->total() / 10000 . "万";
			else
				echo $this->cart->total();
		?>元
	</div>
		<a href="<?php echo base_url()."temple/id/".$this->session->userdata('page_templeid');?>" class="btn btn-info">继续添加</a>
		<?php if($this->cart->total_items() > 0){?>
		<a href="<?php echo base_url();?>checkout" class="btn btn-success">确认支付</a>
		<?php }?>
	</span>
</div>
</div>
<?php $this->load->view('footer');?>