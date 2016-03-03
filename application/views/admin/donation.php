<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">
	<div class="container">
	<?php $this->load->view('crumb')?>
	<div class="alert alert-info">
		<a class="btn btn-danger" onclick="del_confirm()" href=<?php echo base_url()."admin/donation/clear";?>>全部清空</a>
		<?php echo form_open_multipart('admin/donation/import', array('class' => 'form-inline'));?>
		<input class="form-control" style="width:190px;" type="text" readonly id="uploadfilename"/>
		<input style="display:none;" type="file" name="userfile" size="20" onchange="document.getElementById('uploadfilename').value=this.value"/>
		<input class="btn btn-info btn-sm" type="button" onclick=userfile.click() value="选择文件"/>
		<button type="submit" class="btn btn-info btn-sm">导入</button>
		</form>
	</div>
	<div class="alert alert-info">
		<a class="btn btn-info" 
		href=<?php echo base_url()."admin/donation/recent";?>>查看最新供养</a>
	</div>
	<?php foreach($temple as $t):?>  
		<div class="alert alert-info card" role="alert">
		<h3><?php echo $t->name;?><small> - <?php echo $t->province." ".$t->city;?></small></h3>
		<?php echo "供养需求数量：".($t->dcount!=null?$t->dcount:0);?>
		<h5><a href=<?php echo base_url()."admin/donation/temple/".$t->id;?>>查看详情</a></h5>
		</div>
	<?php endforeach;?>  
</div>
</div>
<?php $this->load->view('footer');?>