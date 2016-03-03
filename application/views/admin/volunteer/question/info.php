<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">	
	<div class="container">
	<div class="" role="alert">
		<h3><?php if(isset($question)) echo $question->info;?>
			<small><a href="<?php echo base_url();?>admin/volunteer/question" class="btn btn-default">返回</a></small>
		</h3>
		<div class="form-line">
			类型：<?php if(isset($question)){
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
				}
			?>
		</div>
		<div class="form-line">
			描述：<?php if(isset($question)) echo $question->description;?>
		</div>
	</div>
	<div>
		<h3>问题选项</h3>
		<table class="table table-striped">
			<th>标题</th><th>描述</th><th>是否需要补充信息</th><th>操作</th>
		<?php foreach ($option_list as $option) {
			echo "<tr><td>".$option->info."</td><td>".$option->description."</td><td>".$option->need_detail."</td><td><a href=\"".base_url()."admin/volunteer/question_option_delete/".$question->id."/".$option->id."\">删除</a></td></tr>";
		}?>
		<tr>
			<?php echo form_open('admin/volunteer/question_option_add/'.$question->id, array('class' => 'form-inline'))?>
			<td><input type="text" placeholder="标题" name="info"/></td>
			<td><input type="text" placeholder="描述" name="description"/></td>
			<td><input type="checkbox" value="1" placeholder="详细内容" name="need_detail"/></td>
			<td><button type="submit" class="btn btn-primary">保存</button></td>
			</form>
		</tr>
		</table>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>