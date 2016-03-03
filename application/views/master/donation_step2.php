<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<ol class="breadcrumb">
	  <li>选择供养物</li>
	  <li class="active">填写供养人信息</li>
	  <li>供养信息确认</li>
	</ol>
	<div class="alert alert-info" role="alert">
		<h3>第二步 - 填写供养人信息</h3>
	</div>
	<form action="add_order" method="post" class="form-horizontal" role="form">
	<div class="login panel panel-default">
		<div class="panel-body">
			<div class="form-group">
			    <label class="col-sm-4 control-label">联系人</label>
			    <div class="col-sm-6">
			    <input type="text" class="form-control" name="contact" id="contact" placeholder="联系人"><?php echo form_error('contact')?>
			    </div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">联系电话</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" name="mobile" id="mobile" placeholder="联系电话"><?php echo form_error('mobile')?>
			</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">网站用户名（如有请填写）</label>
				<div class="col-sm-6">
				<input type="username" class="form-control" name="username" id="username" placeholder="网站用户名"><?php echo form_error('username')?>
				</div>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-success"><h5>下一步</h5></button>
	</form>
</div>
</div>
</div>
<?php $this->load->view('footer');?>