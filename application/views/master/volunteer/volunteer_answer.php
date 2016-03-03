<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">
<div class="container">
	<h4><?php echo $volunteer->title?>
		 <small><a href="<?php echo base_url()."master/volunteer/id/".$volunteer->id;?>" class="btn btn-default">返回</a></h4>
	<div class="modal-body">
          <?php 
          	//重组answerlist
          	$ans_arr = array();
          	foreach ($answer_list as $answer) {
          		$ans_arr[$answer->optionid] = $answer;
          	}
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
									if(array_key_exists($option->id, $ans_arr))
										echo "<input type=\"radio\" checked=\"checked\" disabled=\"disabled\"/> ".$option->info;
									else
										echo "<input type=\"radio\" value=\"".$option->id."\" id=\"radiooption".$option->id."\" name=\"radio".$question->id."\" disabled=\"disabled\"/> ".$option->info;
									echo "</label></div>";
									break;
								case 1:
									echo "<div class=\"checkbox\"><label>";
									if(array_key_exists($option->id, $ans_arr))
										echo "<input type=\"checkbox\" checked=\"checked\" disabled=\"disabled\"/>".$option->info;
									else
										echo "<input type=\"checkbox\" value=\"".$option->id."\" id=\"checkboxoption".$option->id."\" name=\"checkbox".$question->id."[]\" disabled=\"disabled\"/>".$option->info;
									echo "</label></div>";
									break;
								default:
									break;
							}
							if($option->need_detail){
								if(array_key_exists($option->id, $ans_arr))
									echo "<input type=\"text\" value=\"".$ans_arr[$option->id]->option_detail."\" disabled=\"disabled\"/>";
								else
									echo "<input type=\"text\" placeholder=\"请填写\" name=\"input".$question->id."\" disabled=\"disabled\"/><br/>";
							}
						}
					}
					?>
				</div>
			<?php $question_num++; endforeach;?>
      </div>
</div>
</div>
<?php $this->load->view('footer');?>