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
        <meta name="keywords" content="智慧寺院,智慧寺庙,智慧庙宇,寺院信息化"/>
        <meta name="description" content="智慧寺院理念帮助寺院将传统的弘扬佛法，登记供养，祈福开示，义工禅修等佛事活动迁移到云端，实现手机app，微信，网站无缝连接。"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/visit.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/temple.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/user.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css">
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
            <marquee direction="left" scrollamount="1" width="60%" height="100%" onmouseover="this.stop()" onmouseout="this.start()" style="height: 100%; width: 60%;">
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            &nbsp;&nbsp;<span><?php if(isset($temple->website) && $temple->website != '') echo $temple->website; else echo '虔诚供养,功德无量!';?></span>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            </marquee>
          </div>
        </div>
      </div>
      <div class="row banner">
        <div class="container">
          <div class="text-center">
            <div class="logo">
              <a href="<?php 
              if($this->session->userdata('usertype') == null || $this->session->userdata('usertype') == 'user')
                echo base_url().'user';
              else if($this->session->userdata('usertype') == 'master')
                echo base_url('master/donation');
              else if($this->session->userdata('usertype') == 'admin')
                echo base_url('admin/manage')
              ?>"><img src="<?php echo base_url();?>assets/images/smartemple-logo.png" height='60'/></a>
            </div>
            <div class="v1-banner-slogan"><?php if(isset($nav_info))
                    echo $nav_info;
            ?></div>

            <?php if($this->session->userdata('usertype') == 'user' 
                   || $this->session->userdata('usertype') == null){?>
              <!-- 如果已经登录 -->
              <?php if($this->session->userdata('username') != null){?>
                <div class="banner-nav rt">
                <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if(mb_strlen($this->session->userdata('realname')) > 4) echo mb_substr($this->session->userdata('realname'),0,4)."..";
                  else
                    echo $this->session->userdata('realname')?>
                     <span class="caret"></span>
                </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="<?php echo base_url();?>user/home">个人中心</a></li>
                    <li><a href="<?php echo base_url();?>user">返回主页</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo base_url();?>login/logout">退出登录</a></li>
                  </ul>
                </div>
                </div>
              <?php }else{?>
                <?php $this->load->view('v1-header-menu');?>
                <?php $this->load->view('login_modal');?>
              <?php }
            } 
                //如果是其他情况，比如是master或者admin
                else{?>
                    <?php if($this->session->userdata('usertype') == 'master'){?>
                      <div class="v1-banner-sign">
                        <?php if($this->session->userdata('username') == ''){?>
                          <a class="btn btn-primary" href="javascript:check_login('<?php echo base_url();?>','<?php echo $this->session->userdata('id');?>')">登录</a>
                        <?php ;} else{
                          //echo $this->session->userdata('realname')." <a href=\"".base_url('login/logout')."\">登出</a>";?>
                        <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if(mb_strlen($this->session->userdata('realname')) > 4) echo mb_substr($this->session->userdata('realname'),0,4)."..";
                          else
                            echo $this->session->userdata('realname')?>
                             <span class="caret"></span>
                        </button>
                          
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                          <li><a href="<?php echo base_url();?>master/news">管理后台</a></li>
                            <li><a href="<?php echo base_url()."temple/id/".$this->session->userdata('templeid');?>">寺院主页</a></li>
                            <li role="separator" class="divider"></li>
                          <li><a href="<?php echo base_url();?>login/logout">退出登录</a></li>
                        </ul>
                        </div>
                        <?php } ?>

                      </div>

                    <?php } else if($this->session->userdata('usertype') == 'admin'){ ?>
                          <div class="v1-banner-sign">
                            <?php if($this->session->userdata('username') == ''){?>
                              <a class="btn btn-primary" href="javascript:check_login('<?php echo base_url();?>','<?php echo $this->session->userdata('id');?>')">登录</a>
                            <?php ;} else{
                              //echo $this->session->userdata('realname')." <a href=\"".base_url('login/logout')."\">登出</a>";?>
                            <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if(mb_strlen($this->session->userdata('realname')) > 4) echo mb_substr($this->session->userdata('realname'),0,4)."..";
                              else
                                echo $this->session->userdata('realname')?>
                                 <span class="caret"></span>
                            </button>
                              
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                              <li><a href="<?php echo base_url();?>admin/manage">管理后台</a></li>
                                <li role="separator" class="divider"></li>
                              <li><a href="<?php echo base_url();?>login/logout">退出登录</a></li>
                            </ul>
                            </div>
                            <?php } ?>

                          </div>
                    <?php }?>
            <?php }?>
          </div>
        </div>
      </div>