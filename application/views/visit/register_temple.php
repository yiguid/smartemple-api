<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_index_header');
?>
		<div class="v1-index-content">
			<div class="panel-body">
			<form action="register" method="post" class="form-horizontal" role="form" id="register">
				<div class="form-info">
					<h3>新寺院登记<br/><small style="color:#E40000;">以下各项均为必填项</small></h3>
				</div>
			  <div class="form-group">
			    <label class="col-sm-4 control-label">寺院名称</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" value="<?php echo set_value('name');?>" name="name" id="name" placeholder="如：古佛寺"><?php echo form_error('name')?>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-4 control-label">名称全拼</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" value="<?php echo set_value('englishname');?>" name="englishname" id="englishname" placeholder="如：古佛寺应写gufosi"><?php echo form_error('englishname')?>
			    </div>
			  </div>
			  <div id="city">
			  <div class="form-group">
			    <label class="col-sm-4 control-label">所在省份</label>
			    <div class="col-sm-6">
			    	<select name="province" id="province" class="prov form-control"></select> <?php echo form_error('province')?>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-4 control-label">所在城市</label>
			    <div class="col-sm-6">
				    <select name="city" id="city" class="city form-control" disabled="disabled"></select><?php echo form_error('city')?>
			    </div>
			  </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-4 control-label">住持</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" value="<?php echo set_value('master');?>" name="master" id="master" placeholder="如：根定法师"><?php echo form_error('master')?>
			    </div>
			    <p class="col-sm-6 control-label">注：住持认证后获得法师账户，可编辑寺院信息
			  	</p>
			  </div>  	
			  <div class="form-group">
			    <label class="col-sm-4 control-label">登记人</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" value="<?php echo set_value('contact');?>" name="contact" id="contact" placeholder="请填写您的全名"><?php echo form_error('contact')?>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-4 control-label">联系电话</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" value="<?php echo set_value('mobile');?>" name="mobile" id="mobile" placeholder="请填写您的手机号"><?php echo form_error('mobile')?>
			      验证码：
				<input name="captcha" id="captcha" style="width:70px;">
				<button type="button" id="captcha-btn" class="btn btn-sm btn-default" data-loading-text="发送中..." autocomplete="off" onclick="javascript:temple_commit_mobile('<?php echo base_url();?>')">获取验证码</button>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-6">
			      <a href="javascript:master_register_submit('<?php echo base_url();?>')" class="v1-btn-brown">登记</a>
			      <span style="padding-left:20px;"></span>
			      <button type="reset" class="v1-btn-grey">重置</button>
			    </div>
			  </div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('v1_footer');?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.cityselect.js"></script>
<script type="text/javascript">
$(function(){
	$("#city").citySelect({
		nodata:"none",
		required:false
	});
});
</script>