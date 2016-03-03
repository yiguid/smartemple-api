<div class="v1-banner-sign">
	<?php if($this->session->userdata('username') == ''){?>
		<a class="btn btn-primary" href="javascript:check_login('<?php echo base_url();?>','<?php echo $this->session->userdata('id');?>','<?php echo $this->session->userdata('userdetail');?>')">登录</a>
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
	  <li><a href="<?php echo base_url();?>user/home">个人中心</a></li>
      <li><a href="<?php echo base_url();?>user">返回主页</a></li>
      <li role="separator" class="divider"></li>
	  <li><a href="<?php echo base_url();?>login/logout">退出登录</a></li>
	</ul>
	</div>
	<?php } ?>

</div>
