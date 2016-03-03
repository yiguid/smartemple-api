<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<div class="alert alert-info" role="alert">
		<h3>寺院规划</h3>
		请在下面添加规划链接和规划图纸：
		<?php echo form_open_multipart('master/plan/update', array('class' => 'form-inline'));?>
		<input type="text" class="form-control" name="planlink" id="planlink" 
			value="<?php echo $temple->planlink;?>"
			placeholder="规划链接">
		<input class="form-control" style="width:190px;" type="text" readonly id="uploadfilename"/>
		<input style="display:none;" type="file" name="userfile" size="20" onchange="document.getElementById('uploadfilename').value=this.value"/>
		<input class="btn btn-info btn-sm" type="button" onclick=userfile.click() value="选择图纸"/>
		<button type="submit" class="btn btn-info btn-sm">上传</button>
		最佳图片尺寸大小：1170x500
		</form>
	</div>
	<div>
		<img src="<?php if($temple->planimg != null)
						echo base_url().$temple->planimg;
					else
						echo "#"?>" width="100%">
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>