<div class="row">
	<div class="page-header">
	  <h3>智慧寺院<br /><small class="col-sm-offset-1"> - 让寺院变得更有智慧！</small></h3>
	</div>
</div>
<div class="row">
	<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url();?>">首页</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php if($this->session->userdata('usertype') == 'admin') {?>
        <li <?php if($nav == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/welcome">智慧地宫</a></li>
        <li <?php if($nav == 'donation') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/donation">智慧化缘</a></li>
        <?php
        }else{
        ?>
        <li <?php if($nav == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>welcome">智慧地宫</a></li>
        <li <?php if($nav == 'donation') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>donation">智慧化缘</a></li>
        <?php }?>
        <li <?php if($nav == 'weixin') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>weixin">智慧祈福</a></li>
      </ul>
      <?php 
      if($this->session->userdata('username')) 
      { ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">欢迎您：<?php echo $this->session->userdata('username');?></a></li>
        <?php if($this->session->userdata('usertype') == 'admin') {?>
        <li <?php if($nav == 'manage') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/manage">寺院管理</a></li>
        <?php
        }?>
        <li><a href="<?php echo base_url();?>login/logout">退出</a></li>
      </ul>
      <?php }?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>