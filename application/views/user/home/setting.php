<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/home/home_nav');
?>
<div class="main row">
<div class="container">
	<h4>基本信息</h4>
	<h5 style="color:#E40000;"><?php if(isset($notice)) echo $notice;?></h5>
	<div class="col-md-8 col-md-offset-2">
		<form action="<?php echo base_url()."user/home/update";?>" method="post" class="form-horizontal" role="form">
		  <div class="form-group">
		    <label class="col-sm-4 control-label">用户名</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" disabled="true" value="<?php echo $user->username;?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">新密码</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="password" id="password" placeholder="如不需修改请留空"><?php echo form_error('password')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">真实姓名</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php echo $user->realname;?>" name="realname" id="realname" placeholder="真实姓名"><?php echo form_error('realname')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-4 col-sm-2">
		      <button type="submit" class="btn btn-primary btn-block">保存</button>
		    </div>
		    <div class="col-sm-2">
		    	<button type="reset" class="btn btn-default btn-block">重置</button>
		    </div>
		  </div>
		</form>
	</div>
</div>
<div class="container">
	<h4 class="v1-divider">详细信息 <small>用于报名禅修，义工等寺院活动</small></h4>
	<div class="col-md-8 col-md-offset-2">
		<form action="<?php echo base_url()."user/home/update_detail";?>" method="post" class="form-horizontal" role="form">
		  <div class="form-group">
		    <label class="col-sm-4 control-label">性别</label>
		    <div class="col-sm-6">
		      <select name="gender" id="gender" class="form-control">
		       	<option value="0" <?php if(isset($user) && $user->gender == 0) echo 'selected="selected"';?>>男</option>
		       	<option value="1" <?php if(isset($user) && $user->gender == 1) echo 'selected="selected"';?>>女</option>
		       </select><?php echo form_error('gender')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">年龄</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->age; else echo set_value('age')?>" name="age" id="age" placeholder="年龄"><?php echo form_error('age')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">身份证号</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->idcard; else echo set_value('idcard')?>" name="idcard" id="idcard" placeholder="身份证号"><?php echo form_error('idcard')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">手机号</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->mobile; else echo set_value('mobile')?>" name="mobile" id="mobile" placeholder="手机号"><?php echo form_error('mobile')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">工作单位/学校</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->company; else echo set_value('company')?>" name="company" id="company" placeholder="工作单位/学校"><?php echo form_error('company')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">职位</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->job; else echo set_value('job')?>" name="job" id="job" placeholder="职位"><?php echo form_error('job')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">QQ</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->qq; else echo set_value('qq')?>" name="qq" id="qq" placeholder="QQ"><?php echo form_error('qq')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">微信号</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->weixin; else echo set_value('weixin')?>" name="weixin" id="weixin" placeholder="微信号"><?php echo form_error('weixin')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">邮箱</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->email; else echo set_value('email')?>" name="email" id="email" placeholder="邮箱"><?php echo form_error('email')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">地址</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->address; else echo set_value('address')?>" name="address" id="address" placeholder="地址"><?php echo form_error('address')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">民族</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->minzu; else echo set_value('minzu')?>" name="minzu" id="minzu" placeholder="民族"><?php echo form_error('minzu')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">学历</label>
		    <div class="col-sm-6">
		      <select name="xueli" id="xueli" class="form-control">
		       	<option value="0" <?php if(isset($user) && $user->xueli == 0) echo 'selected="selected"';?>>初中</option>
		       	<option value="1" <?php if(isset($user) && $user->xueli == 1) echo 'selected="selected"';?>>高中</option>
		       	<option value="2" <?php if(isset($user) && $user->xueli == 2) echo 'selected="selected"';?>>本科</option>
		       	<option value="3" <?php if(isset($user) && $user->xueli == 3) echo 'selected="selected"';?>>硕士</option>
		       	<option value="4" <?php if(isset($user) && $user->xueli == 4) echo 'selected="selected"';?>>博士</option>
		       </select><?php echo form_error('xueli')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">婚否</label>
		    <div class="col-sm-6">
		      <select name="hunfou" id="hunfou" class="form-control">
		       	<option value="0" <?php if(isset($user) && $user->hunfou == 0) echo 'selected="selected"';?>>未婚</option>
		       	<option value="1" <?php if(isset($user) && $user->hunfou == 1) echo 'selected="selected"';?>>已婚</option>
		       	<option value="2" <?php if(isset($user) && $user->hunfou == 2) echo 'selected="selected"';?>>离异</option>
		       	<option value="3" <?php if(isset($user) && $user->hunfou == 3) echo 'selected="selected"';?>>丧偶</option>
		       </select><?php echo form_error('hunfou')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">是否已皈依</label>
		    <div class="col-sm-6">
		      <select name="guiyifou" id="guiyifou" class="form-control">
		       	<option value="0" <?php if(isset($user) && $user->guiyifou == 0) echo 'selected="selected"';?>>否</option>
		       	<option value="1" <?php if(isset($user) && $user->guiyifou == 1) echo 'selected="selected"';?>>是</option>
		       </select><?php echo form_error('guiyifou')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">皈依时间</label>
		    <div class="col-sm-6">
		      <div class="input-group date form-line" id="guiyi-time" data-date-format="yyyy-mm-dd">
			    <input type="text" class="form-control" id="guiyitime" name="guiyitime"
			    		value="<?php if(isset($user)) echo date('Y-m-d', strtotime($user->guiyitime)); else echo set_value('guiyitime');?>" placeholder="皈依时间" readonly>
			    <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
				</div><?php echo form_error('guiyitime')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">签名档</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" value="<?php if(isset($user)) echo $user->more; else echo set_value('more')?>" name="more" id="more" placeholder="签名档"><?php echo form_error('more')?>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-4 col-sm-2">
		      <button type="submit" class="btn btn-primary btn-block">保存</button>
		    </div>
		    <div class="col-sm-2">
		    	<button type="reset" class="btn btn-default btn-block">重置</button>
		    </div>
		  </div>
		</form>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">
		$("#guiyi-time").datetimepicker({
	        language:  'zh-CN',
	    	pickerPosition: "bottom-left",
			autoclose: 1,
			format: "yyyy-mm-dd",
        	minView: 2
		});
	</script>