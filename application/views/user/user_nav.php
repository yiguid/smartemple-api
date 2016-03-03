<div class="row" id="user-nav">
<div class="container">
	<ul>
		<a href="<?php echo base_url()."user"?>">
			<li <?php if($user_nav == 'index') echo "class=\"active\""; ?> >
			
			<span class="glyphicon glyphicon-user"></span> 主 页</li></a>

		<a href="<?php echo base_url()."user/donation";?>">
			<li <?php if($user_nav == 'donation') echo "class=\"active\""; ?> >
			
			<span class="glyphicon glyphicon-tint"></span> 捐 助</li></a>

		<a href="<?php echo base_url()."user/news";?>">
			<li <?php if($user_nav == 'news') echo "class=\"active\""; ?>>
			
			<span class="glyphicon glyphicon-globe"></span> 新 闻</li></a>

		<a href="<?php echo base_url()."user/activity";?>">
			<li <?php if($user_nav == 'activity') echo "class=\"active\""; ?>>
			
			<span class="glyphicon glyphicon-book"></span> 禅 修</li></a>

		<a href="<?php echo base_url()."user/volunteer";?>">
			<li <?php if($user_nav == 'volunteer') echo "class=\"active\""; ?>>
			
			<span class="glyphicon glyphicon-leaf"></span> 义 工</li></a>

		<a href="<?php echo base_url()."user/qf";?>">
			<li <?php if($user_nav == 'qf') echo "class=\"active\""; ?>>
			
			<span class="glyphicon glyphicon-heart"></span> 祈 福</li></a>
	</ul>
</div>
</div>