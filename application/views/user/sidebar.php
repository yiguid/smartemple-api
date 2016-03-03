<div class="sidebar col-md-2">
	<ul class="nav nav-pills nav-stacked" role="tablist">
		<li <?php if($sidebar == 'order') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>user/home/order">我的供养</a></li>
      	<li <?php if($sidebar == 'activity') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>user/home/activity">我的禅修</a></li>
      	<li <?php if($sidebar == 'setting') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>user/home/setting">个人设置</a></li>
	</ul>
</div>