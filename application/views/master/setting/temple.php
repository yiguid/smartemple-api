<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<div class="alert alert-info" role="alert">
		<h3>寺院通知</h3>
		寺院发布的通知将在首页顶部显示：
		<?php echo form_open('master/temple/update_notice', array('class' => 'form-inline'));?>
		<input type="text" class="form-control" name="notice" id="notice" 
			value="<?php echo $temple->website;?>"
			placeholder="寺院通知">
		<button type="submit" class="btn btn-info btn-sm">发布</button>
		</form>
	</div>
	<div class="alert alert-info" role="alert">
		<h3>寺院首页顶部图片</h3>
		<?php echo form_open_multipart('master/temple/update_homeimg', array('class' => 'form-inline'));?>
		<input class="form-control" style="width:190px;" type="text" readonly id="uploadfilename"/>
		<input style="display:none;" type="file" name="userfile" size="20" onchange="document.getElementById('uploadfilename').value=this.value"/>
		<input class="btn btn-info btn-sm" type="button" onclick=userfile.click() value="选择图纸"/>
		<button type="submit" class="btn btn-info btn-sm">上传</button>
		最佳图片尺寸大小：1170x150
		</form>
	</div>
	<div>
		<img src="<?php if($temple->homeimg != null)
						echo base_url().$temple->homeimg;
					else
						echo "#"?>" width="100%">
	</div>
	<div class="alert alert-info" role="alert">
		<h3>寺院其他供养方式</h3>
		其他供养方式将在首页底部展示，多行请使用&ltp&gt&lt/p&gt标签：
		<?php echo form_open('master/temple/update_contacts', array('class' => 'form-inline'));?>
		<textarea type="text" class="form-control" name="contacts" id="contacts" rows="6"
			placeholder="银行账号，开户行等信息"><?php echo $temple->contacts;?></textarea>
		<button type="submit" class="btn btn-info btn-sm">更新</button>
		</form>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>