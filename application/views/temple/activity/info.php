<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="main row">
<div class="container">
	<?php $this->load->view('crumb')?>
	<div class="activity-info">
		<div><h2><?php echo $activity->title?></h2></div>
		<div class="form-line">活动形式：<?php echo $activity->catname?></div>
		<div class="form-line">起止时间：<?php echo $activity->starttime?> - <?php echo $activity->endtime?></div>
		<div class="form-line">费用人数：<?php echo $activity->cost?>元，活动名额<?php echo $activity->capacity?>名</div>

		<div>
			<?php if(!$is_register){?>
			<a href="#" onclick="javascript:check_login('<?php echo base_url();?>','<?php echo $this->session->userdata('id');?>','<?php echo $this->session->userdata('userdetail');?>')" class="btn btn-danger" data-target="#regist-form" >我要报名</a>
			<?php }else{ ?>
			<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">已报名</button>
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
		          <a class="btn btn-primary" href="<?php echo base_url()."user/home/activity"?>">查看所有已报名活动</a>
		          <a class="btn btn-default" onclick="javascript:quit_confirm()" href="<?php echo base_url()."user/activity/quit/".$activity->id?>">取消报名</a>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="regist-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="exampleModalLabel">报名信息</h4>
		      </div>
		      <form action="<?php echo base_url().'user/activity/register/'.$temple->id."/".$activity->id;?>" method="post">
		      <div class="modal-body">
		          <div class="form-group">
		            <label for="applicant" class="control-label">真实姓名</label>
		            <input type="text" class="form-control" id="applicant" name="applicant" value="<?php echo $this->session->userdata('realname')?>">
		          </div>
		          <div class="form-group">
		            <label for="contact" class="control-label">联系方式</label>
		            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $this->session->userdata('username')?>">
		          </div>
		         <!--  <div class="form-group">
		            <label for="remark" class="control-label">备注</label>
		            <textarea class="form-control" id="remark" name="remark"></textarea>
		          </div> -->
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		        <button type="submit" class="btn btn-primary">报名</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>
		<?php $this->load->view('login_modal');?>
		<div>
			<h3>已报名名单</h3>
			<?php foreach ($register_list as $register) {
				echo "<span class=\"btn btn-default\">".$register->applicant."</span>";
			}?>
		</div>

		<div class="form-line">活动内容：<?php echo $activity->content?></div>
	</div>

	
</div>
</div>
<?php $this->load->view('footer');?>
<?php $this->load->view('alert_modal');?>