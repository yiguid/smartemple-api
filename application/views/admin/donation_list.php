<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">
	<div class="container">
	<?php $this->load->view('crumb')?>
	<div class="alert alert-info" role="alert">
		<h3><?php echo $temple->name?> - <small><?php echo "已供养完成".$donation_info->count."件，总善款".round($donation_info->income,2)?>元。</small></h3>
	</div>
	<?php echo form_open_multipart('admin/donation/import/'.$temple->id, array('class' => 'form-inline'));?>
	<input class="form-control" style="width:190px;" type="text" readonly id="uploadfilename"/>
	<input style="display:none;" type="file" name="userfile" size="20" onchange="document.getElementById('uploadfilename').value=this.value"/>
	<input class="btn btn-info btn-sm" type="button" onclick=userfile.click() value="选择文件"/>
	<button type="submit" class="btn btn-info btn-sm">导入</button>
	</form>
	<table class="table table-striped">
		<th>名称</th><th>类别</th><th>详细信息</th><th>单价</th><th>操作</th>
	<?php foreach($donation as $d):?>  
		<tr>
		<?php echo "<td>".$d->name ."</td><td>".$d->type ."</td><td>".$d->info ."</td><td>".$d->price."</td>";?>
		<td><a href="<?php echo base_url()."admin/donation/item/".$d->id; ?>">查看</a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
	</div>
</div>
<?php $this->load->view('footer');?>