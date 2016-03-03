<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="main col-md-10">
	<h3>新增供养</h3>
	<div class="col-md-8 col-md-offset-2">
		<div class="login panel panel-default">
  			<div class="panel-body">
				<?php echo form_open_multipart('master/donation/add', array('class' => 'form-horizontal'));?>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">名称</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" name="name" id="name" placeholder="Name"><?php echo form_error('name')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">类别</label>
				    <div class="col-sm-6">
				    	<select class="form-control" name="type" id="type">
				    		<option value="佛像">佛像</option>
				    		<option value="建材">建材</option>
				    		<option value="设备">设备</option>
				    		<option value="花木">花木</option>
				    	</select>
				      </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">详细</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" name="info" id="info" placeholder="Info"><?php echo form_error('info')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">价格</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" name="price" id="price" placeholder="Price"><?php echo form_error('price')?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">数量</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount"><?php echo form_error('amount')?>
				    </div>
				  </div>
				  <div class="form-group">
				  	<label class="col-sm-4 control-label">图片</label>
				  	<div class="col-sm-6">
				  		<input class="form-control" type="text" readonly id="uploadfilename"/>
						<input style="display:none;" type="file" name="userfile" size="20" onchange="document.getElementById('uploadfilename').value=this.value"/>
						<input class="btn btn-info btn-sm" type="button" onclick=userfile.click() value="选择文件"/>
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