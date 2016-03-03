<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">
	<div class="container">
	<?php $this->load->view('crumb')?>
	<h3>查看供养物</h3>
	<div class="col-md-8 col-md-offset-2">
		<div class="login panel panel-default">
  			<div class="panel-body">
				<form action="<?php echo base_url().$donation->id;?>" method="post" class="form-horizontal" role="form">
				  <div class="form-group">
				    <label class="col-sm-4 control-label">ID</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $donation->id;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">名称</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $donation->name;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">类型</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $donation->type;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">详细信息</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $donation->info;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">价格</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $donation->price;?>
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