<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">		
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>查看供养</h3>
	<div class="col-md-8 col-md-offset-2">
		<div class="login panel panel-default">
  			<div class="panel-body">
				<form action="<?php echo base_url()."master/donation/edit/".$entry->id;?>" method="post" class="form-horizontal" role="form">
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
				    <label class="col-sm-4 control-label">类别</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $entry->type;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">详细信息</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $entry->info;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">价格</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $entry->price;?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">数量</label>
				    <div class="col-sm-4 control-label">
				      <?php echo $entry->soldcount."/".$entry->amount;?>
				    </div>
				  </div>
				  <div class="form-group text-center">
				    <img src="<?php if($entry->img != null) echo base_url().$entry->img?>">
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
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>