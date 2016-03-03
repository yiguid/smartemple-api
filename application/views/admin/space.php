<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="main row">
	<div class="container">
	<?php $this->load->view('crumb')?>
	<h3>查看福位</h3>
	<div class="col-md-8 col-md-offset-2">
		<div class="login panel panel-default">
  			<div class="panel-body">
				<form action="<?php echo base_url().$space->id;?>" method="post" class="form-horizontal" role="form">
				  <div class="form-group">
				    <label class="col-sm-4 control-label">ID</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $space->id;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">名称</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $space->location;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">类别</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $space->class;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">详细信息</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $space->intro;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">图片</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $space->img;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">价格</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $space->price;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-2">
				      <button type="submit" class="btn btn-primary btn-block">选择</button>
				    </div>
				    <div class="col-sm-2">
				    	<a class="btn btn-default btn-block" href="javascript:history.go(-1)">返回</a>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>