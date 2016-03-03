<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
?>
<div class="main row">	
	<div class="container">
	<table class="table table-striped">
		<th>供养人</th><th>联系方式</th><th>网站用户名</th>
		<tr><?php echo "<td>$order->contact</td><td>$order->mobile</td><td>$order->username</td>"?></tr>
	</table>
	<table class="table table-striped">
  <th>名称</th>
  <th>数量</th>
  <th style="text-align:right">单价</th>
  <th style="text-align:right">小计</th>

  <?php $i = 1; ?>

  <?php foreach ($this->cart->contents() as $items): ?>

   <tr>
   	<td>
     <?php echo form_hidden('rowid'.$i, $items['rowid']); ?>
     <?php echo $items['name']; ?>
     <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
       <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
       <?php endforeach; ?>     
     <?php endif; ?>
     </td>
     <td><?php echo $items['qty']; ?></td>
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
	<div id="print-control" align="center">
       <button type="button" class="btn btn-primary" onclick="javascript:start_print()">打印</button>
       <button type="button" class="btn btn-default" onclick="location.href='<?php echo base_url();?>master/donation'">返回</button>
    </div>
</div>
</div>
<?php
$this->load->view('footer');
?>