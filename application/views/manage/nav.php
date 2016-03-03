<div class="row manage-header">
	  <h3>寺院智管平台<br /><small class="col-sm-offset-1"> - 让寺院变得更有智慧！</small></h3>
</div>
<div class="row">
	<div class="navbar-index">
    <!-- Brand and toggle get grouped for better mobile display -->
    <!-- Collect the nav links, forms, and other content for toggling -->
      <ul>
        <li <?php if($nav == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>manage">首页</a></li>
        <li <?php if($nav == 'donation') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>visit">智慧供养</a></li>
        <li <?php if($nav == 'palace') echo "class=\"active\""; ?> >
          <a href="#" data-toggle="popover" data-placement="bottom" tabindex="0" data-trigger="focus" 
          title="智慧地宫" data-content="即将开放，敬请期待！">智慧地宫</a></li>
        <li <?php if($nav == 'master') echo "class=\"active\""; ?> >
          <a href="#" data-toggle="popover" data-placement="bottom" tabindex="1" data-trigger="focus" 
          title="智慧方丈" data-content="即将开放，敬请期待！">智慧方丈</a></li>
      </ul>
      <ul class="rt">
        <li <?php if($nav == 'about') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>about">联系我们</a></li>
        <li <?php if($nav == 'register') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>register">寺院登记</a></li>
      </ul>
  </div>
</div>