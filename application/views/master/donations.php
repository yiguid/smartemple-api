<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<div class="alert alert-info" role="alert">
		<h3>供养物品管理</h3>
		<a href="<?php echo base_url();?>master/donation/add" class="btn btn-primary btn-sm" role="button">新增</a>
		<a href="<?php echo base_url();?>master/donation/export" class="btn btn-primary btn-sm" role="button">导出</a>
		<?php echo form_open_multipart('master/donation/import', array('class' => 'form-inline'));?>
		<input class="form-control" style="width:190px;" type="text" readonly id="uploadfilename"/>
		<input style="display:none;" type="file" name="userfile" size="20" onchange="document.getElementById('uploadfilename').value=this.value"/>
		<input class="btn btn-info btn-sm" type="button" onclick=userfile.click() value="选择文件"/>
		<button type="submit" class="btn btn-info btn-sm">导入</button>
		</form>
	</div>
	<table class="table table-striped">
		<th>ID</th><th>名称</th><th>类别</th><th>详细信息</th><th>单价</th><th>数量</th><th>操作</th>
	<?php foreach($donation as $d):?>  
		<tr>
		<?php echo "<td>".$d->id ."</td><td>".$d->name ."</td><td>".$d->type ."</td><td>".$d->info."</td><td>".$d->price."</td><td>".$d->soldcount."/".$d->amount."</td>";?>
		<td><a href="id/<?php echo $d->id; ?>">查看</a>
		 | <a href="edit/<?php echo $d->id; ?>">编辑</a>
		 | <a href="delete/<?php echo $d->id; ?>" onclick="del_confirm()">删除</a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>