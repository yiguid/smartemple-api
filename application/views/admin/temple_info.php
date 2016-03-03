<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>查看寺院</h3>
	<div class="col-md-10 col-md-offset-1">
		<div class="login panel panel-default">
  			<div class="panel-body">
				<form action="<?php echo base_url()."admin/temple/edit/".$entry->id;?>" method="post" class="form-horizontal" role="form">
				  <div class="form-group">
				    <label class="col-sm-4 control-label">ID</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $entry->id;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">名称</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $entry->name;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">英文名</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $entry->englishname;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">位置</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $entry->province.$entry->city;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">住持</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $entry->master;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-2">
				      <button type="submit" class="btn btn-primary btn-block">编辑</button>
				    </div>
				    <div class="col-sm-2">
				    	<a class="btn btn-default btn-block" href="javascript:history.go(-1)">返回</a>
				    </div>
				  </div>
				</form>
			</div>
		</div>
		<div class="panel panel-default">
  			<div class="panel-body">
  				<h3>寺院管理员</h3>
				<table class="table table-striped">
				    <th>ID</th><th>用户名</th><th>姓名</th>
				      <?php
				      	foreach ($master as $m) {
				      		echo "<tr>";
				      		echo "<td>".$m->id."</td><td>".$m->username."</td><td>".$m->realname."</td>";
				      		echo "</tr>";
				      	}
				      ?>
				</table>
				<form action="<?php echo base_url()."admin/temple/add_master/".$entry->id;?>" method="post" class="form-horizontal" role="form">
					<div class="form-group">
					    <label class="col-sm-4 control-label">用户名</label>
					    <div class="col-sm-4">
					    	<input type="text" class="form-control" name="username" id="username" placeholder="Username"><?php echo form_error('username')?>
					    </div>
					    <div class="input-info"><?php if(isset($add_master_info)) echo $add_master_info;?></div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-2">
					 		<button type="submit" class="btn btn-primary btn-block">添加</button>
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