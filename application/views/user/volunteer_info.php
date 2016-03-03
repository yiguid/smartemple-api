<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>
<div class="main row">
<div class="container">
	<div class="v1-page-news">
		<div><h3><?php echo $volunteer->title?></h3></div>
		<!-- <div class="form-line">活动形式：<?php echo $volunteer->catname?></div> -->
		<div class="v1-page-news-function">
			阅读 <?php echo $volunteer->views?>
			<span style="padding-left:10px;"></span>
			<a href="javascript:ilike(<?php echo "'".base_url()."','volunteer','".$volunteer->id."'";?>)">
			<span id="ilike" class="glyphicon glyphicon-heart-empty">
			</span></a> <span id="ilike-count"><?php echo $volunteer->like?></span>
		</div>
		<div class="form-line v1-activity-time">日期：<?php if(isset($volunteer)) echo date('Y年m月d日', strtotime($volunteer->starttime)).' 至 '.date('Y年m月d日', strtotime($volunteer->endtime));?></div>
		<div class="form-line v1-activity-time">时间：<?php if(isset($volunteer)) echo date('H:i', strtotime($volunteer->starttime)).' - '.date('H:i', strtotime($volunteer->endtime));?></div>
		<div class="form-line v1-activity-time">地点：<?php if(isset($volunteer)) echo $volunteer->location;?></div>
		
		<div class="form-line v1-activity-cost">
		报名情况：
			<div class="progress" style="max-width:500px;">
				<div class="progress-bar progress-bar-primary"
				 role="progressbar" style="width:<?php echo count($register_list)/$volunteer->capacity*100;?>%;min-width:6em;line-height:20px;"><?php echo count($register_list)." / ".$volunteer->capacity;?></div>
			</div>
		</div>
		<div style="margin-top:10px;">
		<?php if(!$is_register && count($register_list) < $volunteer->capacity){?>
		<a href="#" onclick="javascript:check_login('<?php echo base_url();?>','<?php echo $this->session->userdata('id');?>','<?php echo $this->session->userdata('userdetail');?>')" class="btn btn-danger" data-target="#regist-form" >我要报名</a>
		<?php }else if($is_register){ ?>
		<button class="btn btn-primary"  data-toggle="modal" data-target=".bs-example-modal-sm">已报名</button>
		<?php }else{ ?>
		<a href="#" class="btn btn-primary" data-target="#regist-form" >报名已满</a>
		<?php }?>
		</div>
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		    	<div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		          <h4 class="modal-title" id="mySmallModalLabel">报名情况</h4>
		        </div>
		        <div class="modal-body">
		          <a class="btn btn-primary" href="<?php echo base_url()."user/home/volunteer_answer/$volunteer->id"?>">查看报名表</a>
		          <a class="btn btn-primary" href="<?php echo base_url()."user/home/volunteer"?>">查看所有已报名活动</a>
		          <a class="btn btn-default" onclick="javascript:quit_confirm()" href="<?php echo base_url()."user/volunteer/quit/".$volunteer->id?>">取消报名</a>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
		<div  style="border-bottom:1px solid #ccc;padding-bottom:10px;">
		<h3>已报名名单</h3>
		<?php foreach ($register_list as $register) {
			echo "<span class=\"btn btn-default\">".$register->applicant."</span>";
		}?>
		</div>
		<div><p><?php echo $volunteer->content?></p></div>
	</div>
			<?php $this->load->view('user/volunteer_register_modal');?>
			<!-- <div class="modal fade" id="regist-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">报名信息</h4>
			      </div>
			      <form action="<?php echo base_url().'user/volunteer/register/'.$volunteer->hostid."/".$volunteer->id;?>" method="post">
			      <div class="modal-body">
			          <div class="form-group">
			            <label for="applicant" class="control-label">真实姓名</label>
			            <input type="text" class="form-control" id="applicant" name="applicant" value="<?php echo $this->session->userdata('realname')?>">
			          </div>
			          <div class="form-group">
			            <label for="contact" class="control-label">联系方式</label>
			            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $this->session->userdata('username')?>">
			          </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			        <button type="submit" class="btn btn-primary">报名</button>
			      </div>
			      </form>
			    </div>
			  </div>
			</div> -->
	</div>
</div>
</div>
<?php $this->load->view('v1_footer');?>
<?php $this->load->view('alert_modal');?>
<?php $this->load->view('login_modal');?>