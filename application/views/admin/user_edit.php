<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>编辑用户</h3>
	<div class="col-md-8 col-md-offset-2">
		<div class="login panel panel-default">
  			<div class="panel-body">
				<form action="<?php echo base_url()."admin/user/edit/".$entry->id;?>" method="post" class="form-horizontal" role="form">
				  <div class="form-group">
				    <label class="col-sm-4 control-label">用户名</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" value="<?php echo $entry->username;?>" name="username" id="username" placeholder="用户名"><?php echo form_error('username')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">密码</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" value="<?php echo $entry->password;?>" name="password" id="password" placeholder="密码"><?php echo form_error('password')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">真实姓名</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" value="<?php echo $entry->realname;?>" name="realname" id="realname" placeholder="真实姓名"><?php echo form_error('realname')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">类型</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" value="<?php echo $entry->type;?>" name="type" id="type" placeholder="类型"><?php echo form_error('type')?>
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
</div>
</div>
</div>
<?php $this->load->view('footer');?>