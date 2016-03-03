<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<div class="margin20" role="alert">
		<!-- <h3><?php if(isset($activity)) echo "编辑禅修活动"; else echo "发布禅修活动";?></h3> -->
		<?php //echo validation_errors(); ?>
		<?php if(isset($activity)) 
				echo form_open('master/activity/edit/'.$activity->id, array('class' => 'form-inline'));
			else
				echo form_open('master/activity/add', array('class' => 'form-inline'));?>
		<div class="form-line">
			<input type="text" class="form-control" name="title" id="title" 
			value="<?php if(isset($activity)) echo $activity->title; else echo set_value('title');?>"
			placeholder="标题">
			<?php echo form_error('title')?></div>
		<div class="input-group date form-line" id="start-time" data-date-format="yyyy-mm-dd hh:ii">
	    <input type="text" class="form-control" id="starttime" name="starttime" 
	    		value="<?php if(isset($activity)) echo $activity->starttime; else echo set_value('starttime');?>" placeholder="开始时间" readonly>
	    <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
		</div>
		<div class="input-group date form-line" id="end-time" data-date-format="yyyy-mm-dd hh:ii">
	    <input type="text" class="form-control" id="endtime" name="endtime"
	    		value="<?php if(isset($activity)) echo $activity->endtime; else echo set_value('endtime');?>" placeholder="结束时间" readonly>
	    <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
		</div>
		<div class="form-line"><input type="text" class="form-control" name="location" id="location" 
			value="<?php if(isset($activity)) echo $activity->location; else echo set_value('location');?>"
			placeholder="地点"><?php echo form_error('location')?>
		</div>
		<div class="form-line"><input type="text" class="form-control" name="cost" id="cost" 
			value="<?php if(isset($activity)) echo $activity->cost; else echo set_value('cost');?>"
			placeholder="费用"><?php echo form_error('cost')?>
		</div>
		<div class="form-line"><input type="text" class="form-control" name="capacity" id="capacity" 
			value="<?php if(isset($activity)) echo $activity->capacity; else echo set_value('capacity');?>"
			placeholder="人数"><?php echo form_error('capacity')?></div>
		<!-- <div class="form-line">
			<?php echo form_dropdown('catid', $category_options, null, 'class="form-control" id="catid"');?>
	    	<a href="<?php echo base_url()."master/activity/edit_cat/$temple->id";?>" class="btn btn-default" role="button">编辑类别</a>
	    </div> -->
		<div class="form-line">
			<textarea type="text" class="form-control" name="content" id="content" rows="8" style="display:none;"
			placeholder="内容"><?php if(isset($activity)) echo $activity->content; else echo set_value('content');?></textarea>
			<textarea type="text" name="description" id="description" rows="8" style="display:none;">
			</textarea>
			<?php echo form_error('content')?>
			<script id="editor" type="text/plain" style="height:300px;"><?php if(isset($activity)) echo $activity->content; else echo set_value('content');?></script>
		</div>
		<button type="submit" class="btn btn-primary" onclick="javascript:get_ueditor_content()">
			<?php if(isset($activity)) echo "保存"; else echo "发布";?>
		</button>
		</form>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">
		$("#start-time").datetimepicker({
	        language:  'zh-CN',
	    	pickerPosition: "bottom-left",
			autoclose: 1
		});
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