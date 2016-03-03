<div class="global-checkout">
	<div class="global-cart">
	<a href="<?php echo base_url();?>donation/order">
		<span class="glyphicon glyphicon-star" aria-hidden="true"></a>
	</div>
	<div class="global-checkout-info"><?php echo $this->cart->total_items();?>件 ￥<?php echo $this->cart->total()?></div>
	<a href="<?php echo base_url();?>donation/order"><div class="btn btn-warning btn-sm global-checkout-btn">结 算</div></a>
</div>