<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="YI GU">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=yes"/>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/v1-style.css">
		<title>
		<?php if(isset($title))
		        echo $title;
		      else
		        echo "智慧寺院";
		?>
		</title>
		<meta name="keywords" content="智慧寺院,智慧寺庙,智慧庙宇,寺院信息化"/>
		<meta name="description" content="智慧寺院理念帮助寺院将传统的弘扬佛法，登记供养，祈福开示，义工禅修等佛事活动迁移到云端，实现手机app，微信，网站无缝连接。"/>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/ico/apple-icon.png">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/ico/favicon.png">
	</head>
<body>
	<div class="row v1-top">
		<div class="container">
			<marquee direction="left" scrollamount="1" width="60%" height="100%" onmouseover="this.stop()" onmouseout="this.start()" style="height: 100%; width: 60%;">
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            &nbsp;&nbsp;<span>虔诚供养 功德无量</span>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            <span style="margin-left:200px;"></span>
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            &nbsp;&nbsp;<span>何来山深庙小 我有智慧寺院</span>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            <span style="margin-left:200px;"></span>
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            &nbsp;&nbsp;<span>游山参禅 乐水悟道 无限逍遥</span>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            <span style="margin-left:200px;"></span>
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            &nbsp;&nbsp;<span>广种福田 无量功德</span>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
            </marquee>
		</div>
	</div>
	<div class="row v1-banner">
		<div class="container">
			<div class="v1-banner-logo">
				<a href="
				<?php if($this->session->userdata('usertype') == '') 
						echo base_url();
					else if($this->session->userdata('usertype') == 'user')
						echo base_url('user');
					else if($this->session->userdata('usertype') == 'master')
						echo base_url('master/donation');
					else if($this->session->userdata('usertype') == 'admin')
						echo base_url('admin/manage');
				?>">
					<img src="<?php echo base_url()."assets/images/smartemple-logo.png"?>" height="60" alt=""/>
				</a>
			</div>
			<div class="v1-banner-slogan">开启智慧寺院新时代</div>
			<!-- <div class="v1-banner-search">
				<div class="v1-banner-search-input">
					<input type="text" size="20" placeholder="禅修" name="q" id="q"/>
				</div>
				<div class="v1-banner-search-btn"><a href="">搜索</a></div>
			</div> -->
			<?php $this->load->view('v1-header-menu');?>
			<div class="v1-banner-function">
				<a href="<?php echo base_url('user/news/id/13')?>">关于我们</a>
			</div>
			
		<?php $this->load->view('login_modal');?>
		</div>
	</div>