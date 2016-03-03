<div class="row v1-nav">
	<div class="container">
		<a href="<?php echo base_url('user')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'index') echo "active"; ?>">首 页</div></a>
		
		<a href="<?php echo base_url('user/donation')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'donation') echo "active"; ?> ">捐 助</div></a>
		
		<a href="<?php echo base_url('user/news')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'news') echo "active"; ?> ">新 闻</div></a>
		
		<a href="<?php echo base_url('user/activity')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'activity') echo "active"; ?> ">禅 修</div></a>
		
		<a href="<?php echo base_url('user/volunteer')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'volunteer') echo "active"; ?> ">义 工</div></a>
		
		<a href="<?php echo base_url('user/qf')?>"><div class="v1-w16 v1-nav-item <?php if($nav == 'qf') echo "active"; ?> ">留 言</div></a>
	</div>
</div>