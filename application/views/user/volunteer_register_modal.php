<div class="modal fade" id="regist-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">报名信息</h4>
      </div>

      <?php echo form_open('user/volunteer/register/'.$volunteer->hostid."/".$volunteer->id);?>
      <div class="modal-body">
          <?php 
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
									echo "<input type=\"radio\" value=\"".$option->id."\" id=\"radiooption".$option->id."\" name=\"radio".$question->id."\" /> ".$option->info;
									echo "</label></div>";
									break;
								case 1:
									echo "<div class=\"checkbox\"><label>";
									echo "<input type=\"checkbox\" value=\"".$option->id."\" id=\"checkboxoption".$option->id."\" name=\"checkbox".$question->id."[]\"/>".$option->info;
									echo "</label></div>";
									break;
								default:
									break;
							}
							if($option->need_detail)
								echo "<input type=\"text\" placeholder=\"请填写\" name=\"input".$question->id."\"/><br/>";
						}
					}
					?>
				</div>
			<?php $question_num++; endforeach;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary" onclick="javascript:check_form()">提交</button>
      </div>
      </form>
    </div>
  </div>
</div>