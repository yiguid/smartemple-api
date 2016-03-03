<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
<div class="container">
	<h3>预览问卷 <a href="<?php echo base_url();?>master/volunteer" class="btn btn-primary" role="button">返回</a></h3>	
	<div id="body">
		<?php 
		echo form_open('master/volunteer/question_preview/');
		$question_num = 1;
		foreach($question_list as $question):?>  
			<div class="v1-divider"></div>
			<h4><?php echo $question_num."、".$question->info;?>
				<br/><small style="padding-left:2em;"><?php echo $question->description?></small></h4>
			<div class="v1-question-option">
				<?php 
				foreach ($option_list as $option) {
					//如果有对应的选项
					if($option->questionid == $question->id){
						//查看问题的类型，是单选，多选还是问答
						switch ($question->type) {
							case 0:
								echo "<div class=\"radio\"><label>";
								echo "<input type=\"radio\" value=\"radiooption".$option->id."\" id=\"radiooption".$option->id."\" name=\"radio".$question->id."\" /> ".$option->info;
								echo "</label></div>";
								break;
							case 1:
								echo "<div class=\"checkbox\"><label>";
								echo "<input type=\"checkbox\" value=\"checkboxoption".$option->id."\" id=\"checkboxoption".$option->id."\" name=\"checkbox".$question->id."\"/>".$option->info;
								echo "</label></div>";
								break;
							default:
								break;
						}
						if($option->need_detail)
							echo "<input type=\"text\" name=\"input".$question->id."\"/><br/>";
					}
				}
				?>
			</div>
		<?php $question_num++; endforeach;?>
		<div class="v1-divider"></div>
		<button type="submit" class="btn btn-primary" onclick="javascript:check_form()">提交
		</button>
		</form>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>