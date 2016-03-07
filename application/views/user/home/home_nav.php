<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/v1-style.css">
<div class="row v1-nav">
	<div class="container">
		<a href="<?php echo base_url('user/home/setting')?>"><div class="v1-w16 v1-nav-item <?php if($home_nav == 'setting') echo "active"; ?>">帐 户</div></a>
		
		<a href="<?php echo base_url('user/home/order')?>"><div class="v1-w16 v1-nav-item <?php if($home_nav == 'order') echo "active"; ?> ">捐 助</div></a>
		
		<a href="<?php echo base_url('user/home/activity')?>"><div class="v1-w16 v1-nav-item <?php if($home_nav == 'activity') echo "active"; ?> ">活 动</div></a>

		<a href="<?php echo base_url('user/home/volunteer')?>"><div class="v1-w16 v1-nav-item <?php if($home_nav == 'volunteer') echo "active"; ?> ">义 工</div></a>
		
		<a href="<?php echo base_url('user/home/qf')?>"><div class="v1-w16 v1-nav-item <?php if($home_nav == 'qf') echo "active"; ?> ">留 言</div></a>
	</div>
</div>

<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/v1-user-home.css">