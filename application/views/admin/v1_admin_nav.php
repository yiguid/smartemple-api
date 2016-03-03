<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/v1-style.css">
<div class="row v1-nav">
	<div class="container">
		<a href="<?php echo base_url('admin/manage')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'manage') echo "active"; ?>">系 统</div></a>
		
		<a href="<?php echo base_url('admin/news')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'news') echo "active"; ?> ">新 闻</div></a>

		<a href="<?php echo base_url('admin/donation')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'donation') echo "active"; ?> ">捐 助</div></a>
		
		<a href="<?php echo base_url('admin/activity')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'activity') echo "active"; ?> ">禅 修</div></a>
		
		<a href="<?php echo base_url('admin/volunteer')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'volunteer') echo "active"; ?> ">义 工</div></a>
		
		<a href="<?php echo base_url('admin/qf')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'qf') echo "active"; ?> ">留 言</div></a>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/v1-master.css">