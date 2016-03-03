<div class="row" id="temple-nav">
<div class="container">
	<ul>
		<li <?php if($temple_nav == 'home') echo "class=\"active\""; ?> >
			<a href="<?php echo base_url()."temple/home/$temple->id"?>">
			<span class="glyphicon glyphicon-home"></span> 主 页</a></li>

		<li <?php if($temple_nav == 'donation') echo "class=\"active\""; ?> >
			<a href="<?php echo base_url()."temple/id/$temple->id"?>">
			<span class="glyphicon glyphicon-tint"></span> 捐 助</a></li>

		<li <?php if($temple_nav == 'news') echo "class=\"active\""; ?>>
			<a href="<?php echo base_url()."news/temple/$temple->id"?>">
			<span class="glyphicon glyphicon-globe"></span> 新 闻</a></li>

		<li <?php if($temple_nav == 'activity') echo "class=\"active\""; ?>>
			<a href="<?php echo base_url()."activity/temple/$temple->id"?>">
			<span class="glyphicon glyphicon-book"></span> 禅 修</a></li>

		<li <?php if($temple_nav == 'volunteer') echo "class=\"active\""; ?>>
			<a href="<?php echo base_url()."volunteer/temple/$temple->id"?>">
			<span class="glyphicon glyphicon-leaf"></span> 义 工</a></li>

		<li <?php if($temple_nav == 'qf') echo "class=\"active\""; ?>>
			<a href="<?php echo base_url()."qf/temple/$temple->id"?>">
			<span class="glyphicon glyphicon-heart"></span> 祈 福</a></li>
	</ul>
</div>
</div>