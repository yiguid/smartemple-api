<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
<div class="container">
	<div class="alert alert-info" role="alert">
		<h3><?php if(isset($question)) echo "编辑问卷问题"; else echo "添加问卷问题";?></h3>
		<?php //echo validation_errors(); ?>
		<?php if(isset($question)) 
				echo form_open('admin/volunteer/question_edit/'.$question->id, array('class' => 'form-inline'));
			else
				echo form_open('admin/volunteer/question_add', array('class' => 'form-inline'));?>
		<div class="form-line">
			<?php echo form_dropdown('type', $question_types, !isset($question)?null:$question->type, 'class="form-control" id="templeid"');?>
	    </div>
		<div class="form-line">
			<input type="text" class="form-control" name="info" id="info" 
			value="<?php if(isset($question)) echo $question->info; else echo set_value('question');?>"
			placeholder="标题">
			<?php echo form_error('info')?></div>
		<div class="form-line"><input type="text" class="form-control" name="description" id="description" 
			value="<?php if(isset($question)) echo $question->description; else echo set_value('description');?>"
			placeholder="描述"><?php echo form_error('description')?>
		</div>
	    
		<button type="submit" class="btn btn-info btn-sm">
			<?php if(isset($question)) echo "保存"; else echo "添加";?>
		</button>
		</form>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>