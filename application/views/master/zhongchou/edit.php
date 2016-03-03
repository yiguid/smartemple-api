<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10 margin20">
	<?php echo validation_errors(); ?>
	<?php if(isset($zhongchou)) 
			echo form_open_multipart('master/zhongchou/edit/'.$zhongchou->id, array('class' => 'form-inline'));
		else
			echo form_open_multipart('master/zhongchou/add', array('class' => 'form-inline'));?>
		<div class="form-line">
			<input type="text" class="form-control"  value="<?php if(isset($zhongchou)) echo $zhongchou->title;else echo set_value('title');?>" id="title" name="title" placeholder="标题">
		</div>
	  <div class="input-group date form-line" id="end-time" data-date-format="yyyy-mm-dd hh:ii">
	    <input type="text" class="form-control" id="endtime" name="endtime"
	    		value="<?php if(isset($zhongchou)) echo $zhongchou->endtime; else echo set_value('endtime');?>" placeholder="结束时间" readonly>
	    <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
		</div>
	  <div class="form-line">
	    <input type="text" class="form-control" value="<?php if(isset($zhongchou)) echo $zhongchou->target;else echo set_value('target');?>"  id="target" name="target" placeholder="捐款总金额">
	  </div>
		<div class="form-line">
			<input class="form-control" style="width:190px;" type="text" readonly id="uploadfilename"/>
			<input style="display:none;" type="file" name="userfile" size="20" onchange="document.getElementById('uploadfilename').value=this.value"/>
			<input class="btn btn-primary" type="button" onclick=userfile.click() value="选择封面图"/>
			最佳图片尺寸大小：585x300
			<?php if(isset($zhongchou) && $zhongchou->img != '') echo "<img style=\"max-height:200px;max-width:100%;width:auto;\" src=\"".base_url().$zhongchou->img."\"/>";?>
		</div>
	  <div class="form-line">
	  	<textarea type="text" class="form-control" name="content" id="content" rows="8" style="display:none;"
			placeholder="内容"></textarea>
			<textarea type="text" name="description" id="description" rows="8" style="display:none;">
			</textarea>
			<script id="editor" type="text/plain" style="height:300px;"><?php if(isset($zhongchou)) echo $zhongchou->content;else echo set_value('content');?></script>
	  </div>
	  <div class="form-line">
	  	<button type="submit" onclick="javascript:get_ueditor_content()" class="btn btn-primary">
			<?php if(isset($zhongchou)) echo "保存"; else echo "发布";?>
		</button> <a href="<?php echo base_url('master/zhongchou');?>" class="btn btn-default">返回</a>
		</div>
	</form>
</div>
</div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">
	$("#end-time").datetimepicker({
        language:  'zh-CN',
    	pickerPosition: "bottom-left",
		autoclose: 1
    });
</script>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/js/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/js/ueditor.all.min.js"> </script>
<script type="text/javascript">
	var ue = UE.getEditor('editor');
	function get_ueditor_content(){
		$('#content').html(UE.getEditor('editor').getContent());
		$('#description').html(UE.getEditor('editor').getContentTxt());
	}
</script>