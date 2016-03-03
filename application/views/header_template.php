<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="YI GU">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=yes"/>
        <title>
            <?php if(isset($title))
                    echo $title;
                  else
                    echo "智慧寺院";
            ?>
        </title>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/visit.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/temple.css">
        <!--[if lt IE 9]>
          <script src="assets/js/html5shiv.js"></script>
          <script src="assets/js/respond.min.js"></script>
        <![endif]-->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/ico/apple-icon.png">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/ico/favicon.png">
    </head>
    <body>
      <div class="row top">
        <div class="container">
          <div class="text-center">
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            &nbsp;&nbsp;虔诚供养,功德无量!&nbsp;&nbsp;
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
          </div>
        </div>
      </div>
      <div class="row banner">
        <div class="container">
          <div class="text-center">
            <div class="logo"><a href="<?php echo base_url();?>temple"><img src="<?php echo base_url();?>assets/images/flower.png"/>智慧供养</a></div>
            <?php if($this->session->userdata('usertype') == 'user' ){?>
            <div class="banner-nav nav-left"><a href="<?php echo base_url();?>temple#shida">佛的十大供养</a></div>
            <div class="banner-nav nav-left"><a href="<?php echo base_url();?>temple#xiujian">供养寺院修建</a></div>
            <div class="banner-nav nav-left"><a href="<?php echo base_url();?>temple#fofaseng">供养佛法僧</a></div>
            <div class="banner-nav nav-left"><a href="<?php echo base_url();?>temple#aide">爱的供养计划</a></div>
              <?php if($this->session->userdata('username') != null){?>
              <div class="banner-nav nav-left"><a href="<?php echo base_url();?>qf">祈福平台</a></div>
              <div class="banner-nav rt">
              <div class="dropdown">
                <a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown"
                 aria-haspopup="true" role="button" aria-expanded="false">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                  <?php echo $this->session->userdata('realname');?>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                  <li><a href="<?php echo base_url();?>user">个人中心</a></li>
                  <li role="presentation" class="divider"></li>
                  <li><a href="<?php echo base_url();?>login/logout">退出登录</a></li>
                </ul>
              </div>
              </div>
              <div class="banner-nav nav-left rt">
                <a href="<?php echo base_url();?>donation/order">
                <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>结算
                </a>
              </div>
              <div class="banner-nav nav-right rt">
                  <div class="dropdown">
                  <a id="dLabel2" data-target="#" href="javascript:void(0)" data-toggle="dropdown"
                   aria-haspopup="true" role="button" aria-expanded="false">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    导航
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel2">
                    <li><a href="<?php echo base_url();?>temple#shida">佛的十大供养</a></li>
                    <li><a href="<?php echo base_url();?>temple#xiujian">供养寺院修建</a></li>
                    <li><a href="<?php echo base_url();?>temple#fofaseng">供养佛法僧</a></li>
                    <li><a href="<?php echo base_url();?>temple#aide">爱的供养计划</a></li>
                    <li><a href="<?php echo base_url();?>donation">查看所有供养</a></li>
                    <li><a href="<?php echo base_url();?>qf">祈福平台</a></li>
                    <li role="presentation" class="divider"></li>
                    <li><a href="<?php echo base_url();?>donation/order">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>结算
                        </a>
                    </li>
                  </ul>
                </div>
              </div>
              <?php }else{?>
              <div class="banner-nav rt">
              <a href="<?php echo base_url()?>login">
              <span class="glyphicon glyphicon-home" aria-hidden="true"></span>登录
              </a>
              </div>
              <div class="banner-nav rt">
              <a href="<?php echo base_url()?>visit">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>游客
              </a>
              </div>
              <?php }?>
            <?php } else{?>
            <!-- 顶部的nav不显示 -->
              <div class="nav-info"><?php if(isset($nav_info)) echo $nav_info;?></div>
            <?php }?>
          </div>
        </div>
      </div>