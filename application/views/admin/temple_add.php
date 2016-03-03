<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>新增寺院</h3>
	<div class="col-md-8 col-md-offset-2">
		<div class="login panel panel-default">
  			<div class="panel-body">
				<form action="add" method="post" class="form-horizontal" role="form">
				  <div class="form-group">
				    <label class="col-sm-4 control-label">名称</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" name="name" id="name" placeholder="Name"><?php echo form_error('name')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">英文名</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" name="englishname" id="englishname" placeholder="English"><?php echo form_error('englishname')?>
				    </div>
				  </div>
				  <div id="city">
				  <div class="form-group">
				    <label class="col-sm-4 control-label">省份</label>
				    <div class="col-sm-6">
				    	<select name="province" id="province" class="prov form-control"></select> <?php echo form_error('province')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">城市</label>
				    <div class="col-sm-6">
					    <select name="city" id="city" class="city form-control" disabled="disabled"></select><?php echo form_error('city')?>
				    </div>
				  </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">住持</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" name="master" id="master" placeholder="Master"><?php echo form_error('master')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-2">
				      <button type="submit" class="btn btn-primary btn-block">新增</button>
				    </div>
				    <div class="col-sm-2">
				    	<button type="reset" class="btn btn-default btn-block">重置</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.cityselect.js"></script>
<script type="text/javascript">
$(function(){
	$("#city").citySelect({
		nodata:"none",
		required:false,
		url: '<?php echo base_url();?>' + "assets/js/city.min.js"
	});
});
</script>