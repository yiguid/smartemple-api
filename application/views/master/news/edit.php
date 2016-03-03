<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<div class="margin20" role="alert"><!-- 
		<h3><?php if(isset($news)) echo "编辑新闻"; else echo "发布新闻";?></h3> -->
		<?php echo validation_errors(); ?>
		<?php if(isset($news)) 
				echo form_open_multipart('master/news/edit/'.$news->id, array('class' => 'form-inline'));
			else
				echo form_open_multipart('master/news/add', array('class' => 'form-inline'));?>
		<div class="form-line">
			<input type="text" class="form-control" name="title" id="title" 
			value="<?php if(isset($news)) echo $news->title;?>"
			placeholder="标题">
			<?php echo form_error('title')?></div>
		<div class="form-line">
			<input class="form-control" style="width:190px;" type="text" readonly id="uploadfilename"/>
			<input style="display:none;" type="file" name="userfile" size="20" onchange="document.getElementById('uploadfilename').value=this.value"/>
			<input class="btn btn-primary" type="button" onclick=userfile.click() value="选择封面图"/>
			最佳图片尺寸大小：585x300
			<?php if(isset($news) && $news->thumb != '') echo "<img style=\"max-height:200px;max-width:100%;width:auto;\" src=\"".base_url().$news->thumb."\"/>";?>
		</div>
		<div class="form-line">
			<textarea type="text" class="form-control" name="content" id="content" rows="8" style="display:none;"
			placeholder="内容"></textarea>
			<textarea type="text" name="description" id="description" rows="8" style="display:none;">
			</textarea>
			<?php echo form_error('content')?>
			<script id="editor" type="text/plain" style="height:300px;"><?php if(isset($news)) echo $news->content;?></script>
		</div>
		<button type="submit" onclick="javascript:get_ueditor_content()" class="btn btn-primary">
			<?php if(isset($news)) echo "保存"; else echo "发布";?>
		</button>
		</form>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/js/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/js/ueditor.all.min.js"> </script>
<script type="text/javascript">
	var ue = UE.getEditor('editor');
	function get_ueditor_content(){
		$('#content').html(UE.getEditor('editor').getContent());
		$('#description').html(UE.getEditor('editor').getContentTxt());
	}
</script>
