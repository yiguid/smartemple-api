<div class="row">
  <div class="container">
	<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        展开菜单
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling 
      <li <?php if($nav == 'digong') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/digong">智慧地宫</a></li>
    -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php if($this->session->userdata('usertype') == 'master') {?>
        <li <?php if($nav == 'setting') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/setting">基本设置</a></li>
        <!-- <li <?php if($nav == 'calendar') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/calendar">我的日历</a></li> -->
        <li <?php if($nav == 'news') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/news">新闻管理</a></li>
        <li <?php if($nav == 'donation') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/donation">捐助管理</a></li>
        <li <?php if($nav == 'activity') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/activity">禅修管理</a></li>
        <li <?php if($nav == 'volunteer') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/activity">义工管理</a></li>
        <li <?php if($nav == 'qf') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/qf">留言管理</a></li>
        <!-- <li <?php if($nav == 'economy') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/economy">寺院经济</a></li> -->
        <!-- <li <?php if($nav == 'account') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/account">账号管理</a></li> -->
        <?php
        }else if($this->session->userdata('usertype') == 'admin'){
        ?>
        <li <?php if($nav == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/overview">管理首页</a></li>
        <li <?php if($nav == 'news') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/news">新闻管理</a></li>
        <li <?php if($nav == 'donation') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/donation">捐助管理</a></li>
        <li <?php if($nav == 'activity') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/activity">禅修管理</a></li>
        <li <?php if($nav == 'volunteer') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/volunteer">义工管理</a></li>
        <li <?php if($nav == 'qf') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/qf">留言管理</a></li>
        <!-- <li <?php if($nav == 'digong') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/digong">智慧地宫</a></li> -->
        <?php
        }else{
        ?>
        <li <?php if($nav == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url()."temple";?>">寺院首页</a></li>
        <li <?php if($nav == 'donation') echo "class=\"active\""; ?> ><a href="<?php echo base_url()."temple/donation";?>">智慧供养</a></li>
        <li <?php if($nav == 'qf') echo "class=\"active\""; ?> ><a href="<?php echo base_url()."qf";?>">智慧祈福</a></li>
        <?php }?>        
      </ul>
      <?php 
      if($this->session->userdata('username')) 
      { ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">欢迎您：<?php echo $this->session->userdata('realname');?></a></li>
        <?php if($this->session->userdata('usertype') == 'admin') {?>
        <li <?php if($nav == 'manage') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/manage">系统管理</a></li>
        <?php
        }?>
        <li><a href="<?php echo base_url();?>login/logout">退出</a></li>
      </ul>
      <?php }
      else{?>
      <ul class="nav navbar-nav navbar-right">
        <li <?php if($nav == 'login') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>login">登录</a></li>
        <li <?php if($nav == 'register') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>register">注册</a></li>
      </ul>
      <?php }?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>
</div>
</div>