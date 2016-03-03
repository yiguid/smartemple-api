<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">  
  <div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<ol class="breadcrumb">
	  <li>选择供养物</li>
	  <li>填写供养人信息</li>
	  <li class="active">供养信息确认</a></li>
	</ol>
	<div class="alert alert-info" role="alert">
		<h3>第三步 - 确认供养信息</h3>
	</div>
  <table class="table table-striped">
    <th>供养人</th><th>联系电话</th><th>网站用户名</th>
    <tr><?php echo "<td>$order->contact</td><td>$order->mobile</td><td>$order->username</td>"?></tr>
  </table>
	<table class="table table-striped">
  <th>数量</th>
  <th>名称</th>
  <th style="text-align:right">单价</th>
  <th style="text-align:right">小计</th>

  <?php $i = 1; ?>

  <?php foreach ($this->cart->contents() as $items): ?>

   <tr>
     <td><?php echo form_input(array('name' => 'qty'.$i, 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
     <td>
     <?php echo form_hidden('rowid'.$i, $items['rowid']); ?>
     <?php echo $items['name']; ?>
     <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
       <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
       <?php endforeach; ?>     
     <?php endif; ?>
     </td>
     <td style="text-align:right"><?php echo $items['price']; ?>元</td>
     <td style="text-align:right"><?php echo $items['subtotal']; ?>元</td>
   </tr>
  <?php $i++; ?>
  <?php endforeach; ?>
  <tr>
    <td colspan="2"></td>
    <td class="right"><strong>总计</strong></td>
    <td class="right"><?php echo $this->cart->total(); ?>元</td>
  </tr>
  </table>
	<a class="btn btn-success" href="step_commit"><h5>确认信息&打印</h5></a>
  <a class="btn btn-default" href="step1"><h5>取消重填</h5></a>
</div>
</div>
</div>
<?php $this->load->view('footer');?>