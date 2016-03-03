<div class="sidebar col-md-2">
	<ul class="nav nav-pills nav-stacked" role="tablist">
	  <?php if($this->session->userdata('usertype') == 'master'){ 
	  	if($nav == 'digong'){?>
	      	<li <?php if($sidebar == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/digong">数据总览</a></li>
		  	<li <?php if($sidebar == 'space') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/space">福位管理</a></li>
		  	<li <?php if($sidebar == 'decedent') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/decedent">往生者管理</a></li>
		  	<li <?php if($sidebar == 'offering') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/offering">供养管理</a></li>
		<?php } 
	  	else if($nav == 'donation'){?>
	  		<!-- <a href="<?php echo base_url();?>master/donation/step1"><button type="button" class="btn btn-info">供养登记</button></a>-->
	  		<li <?php if($sidebar == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/donation">查看最新供养</a></li>
      		<li <?php if($sidebar == 'donation') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/donation/donations">编辑供养物品</a></li>
                  <li <?php if($sidebar == 'zhongchou') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/zhongchou">查看我的众筹</a></li>
                  <li <?php if($sidebar == 'zhongchou_add') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/zhongchou/add">发起众筹项目</a></li>
      	<?php } 
	  	else if($nav == 'setting'){?>
      		<li <?php if($sidebar == 'setting') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/setting">我的简介</a></li>
      		<li <?php if($sidebar == 'temple') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/temple">我的寺院</a></li>
      		<li <?php if($sidebar == 'plan') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/plan">我的规划</a></li>
      		<a target="_blank" href="<?php echo base_url('temple/home/').'/'.$temple->id;?>"><button type="button" class="btn btn-eee btn-block">预览主页</button></a>
      		
      	<?php } 
            else if($nav == 'calendar'){?>
                  <li <?php if($sidebar == 'calendar') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/calendar">佛教节日</a></li>
                  <li <?php if($sidebar == 'notice') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/calendar">设置提醒</a></li>
                  <li <?php if($sidebar == 'share') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/calendar">分享日历</a></li>
                  
            <?php } 
            else if($nav == 'activity'){?>
                  <li <?php if($sidebar == 'activity') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/activity">禅修列表</a></li>
                  <li <?php if($sidebar == 'add') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/activity/add">发布禅修</a></li>
            <?php } 
            else if($nav == 'volunteer'){?>
                  <li <?php if($sidebar == 'volunteer') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/volunteer">义工信息列表</a></li>
                  <li <?php if($sidebar == 'add') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/volunteer/add">发布义工招募</a></li>
            <?php } 
            else if($nav == 'economy'){?>
                  <li <?php if($sidebar == 'economy') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/economy">寺院收入</a></li>
                  <li <?php if($sidebar == 'other') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/economy">寺院支出</a></li>
            <?php } 
            else if($nav == 'account'){?>
                  <li <?php if($sidebar == 'account') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/account">管理员管理</a></li>
                  <li <?php if($sidebar == 'user') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/account">居士管理</a></li>
            <?php } 
            else if($nav == 'news'){?>
                  <li <?php if($sidebar == 'news') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/news">新闻列表</a></li>
                  <li <?php if($sidebar == 'add') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>master/news/add">发布新闻</a></li>
            <?php }  
      }else if($this->session->userdata('usertype') == 'admin'){
      		if($nav == 'manage'){?>
	  		<li <?php if($sidebar == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/manage">数据总览</a></li>
	  		<li <?php if($sidebar == 'user') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/user">用户管理</a></li>
	  		<li <?php if($sidebar == 'temple') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/temple">寺院管理</a></li>
	  		<li <?php if($sidebar == 'register') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/register">登记管理</a></li>
      	      <li <?php if($sidebar == 'message') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>admin/message">消息管理</a></li>
            <?php }
      }
      else{
      	if($nav == 'digong'){?>
      	<li <?php if($sidebar == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>digong">智慧地宫</a></li>
      	<?php } 
      	else if($nav == 'donation'){?>
      	<li <?php if($sidebar == 'index') echo "class=\"active\""; ?> ><a href="<?php echo base_url();?>donation">智慧化缘</a></li>
      	<?php }
  	  }?>
	</ul>
</div>