<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
<div class="container">
	<h3>问题列表 <a href="<?php echo base_url();?>admin/volunteer" class="btn btn-primary" role="button">返回义工招募</a></h3>
	<div class="row manage form-line">
	<div class="col-md-3">
		<a href="<?php echo base_url();?>admin/volunteer/question_add" class="btn btn-primary" role="button">添加问题</a>
		<a href="<?php echo base_url();?>admin/volunteer/question_preview" class="btn btn-primary" role="button">预览问卷</a>
	</div>
	<div class="col-md-8"></div>
	<div class="col-md-1">
	</div>
	</div>
	
	<div id="body">
		<table class="table table-striped">
			<tr>
				<td>ID</td>
				<td>类型</td>
				<td>标题</td>
				<td>描述</td>
				<td>操作</td>
			</tr>
		<?php foreach($question_list as $question):?>  
				<tr>
					<td><?php echo $question->id?></td>
					<td><?php 
					switch ($question->type) {
						case 0:
							echo '单选';
							break;
						case 1:
							echo '多选';
							break;
						case 2:
							echo '问答';
							break;
						default:
							# code...
							break;
					}
					?></td>
					<td><?php echo "<a href=\"".base_url()."admin/volunteer/question_id/$question->id\">".$question->info."</a>"?></td>
					<td><?php echo $question->description?></td>
					<td><?php echo "<a href=\"".base_url()."admin/volunteer/question_id/$question->id\">编辑问题选项</a>"?> | <a href="<?php echo base_url();?>admin/volunteer/question_edit/<?php echo $question->id;?>" />编辑</a> | <a href="<?php echo base_url();?>admin/volunteer/question_delete/<?php echo $question->id;?>" onclick="del_confirm()"/>删除</a></td>
				</tr>
		<?php endforeach;?>
		</table>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>