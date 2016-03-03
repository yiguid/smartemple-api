<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="main row">
<div class="container">
	<?php $this->load->view('crumb')?>
	<div class="volunteer-info">
		<div><h2><?php echo $volunteer->title?></h2></div>
		<div class="form-line">起止时间：<?php echo $volunteer->starttime?> - <?php echo $volunteer->endtime?></div>
		<div class="form-line">活动名额：<?php echo $volunteer->capacity?>名</div>

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
		          <a class="btn btn-primary" href="<?php echo base_url()."user/home/volunteer_answer/$volunteer->id"?>">查看报名表</a>
		          <a class="btn btn-primary" href="<?php echo base_url()."user/home/volunteer"?>">查看所有已报名活动</a>
		          <a class="btn btn-default" onclick="javascript:quit_confirm()" href="<?php echo base_url()."user/volunteer/quit/".$volunteer->id?>">取消报名</a>
		        </div>
		      </div>
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

		<div class="form-line">活动内容：<?php echo $volunteer->content?></div>
	</div>

	
</div>
</div>
<?php $this->load->view('user/volunteer_register_modal');?>
<?php $this->load->view('alert_modal');?>
<?php $this->load->view('footer');?>