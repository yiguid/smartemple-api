<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="row">
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="main row col-md-10">
	<h3>新增福位</h3>
	<div class="col-md-8 col-md-offset-2">
		<div class="login panel panel-default">
  			<div class="panel-body">
				<form action="add" method="post" class="form-horizontal" role="form">
				  <div class="form-group">
				    <label class="col-sm-4 control-label">位置</label>
				    <div class="col-sm-6">
				      <input type="location" class="form-control" name="location" id="location" placeholder="Location"><?php echo form_error('location')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">级别</label>
				    <div class="col-sm-6">
				      <input type="class" class="form-control" name="class" id="class" placeholder="Class"><?php echo form_error('class')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">价格</label>
				    <div class="col-sm-6">
				      <input type="price" class="form-control" name="price" id="price" placeholder="Price"><?php echo form_error('price')?>
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