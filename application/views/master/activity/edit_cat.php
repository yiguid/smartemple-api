<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<div class="alert alert-info" role="alert">
		<h3>编辑禅修活动分类
			<small><a href="<?php echo base_url();?>master/activity/add" class="btn btn-default">返回</a></small>
		</h3>
	</div>
	<table class="table table-striped" id="catoptable">
		<th>id</th><th>名称</th><th>操作</th>
		<?php
		foreach ($activity_cat as $cat) {
			echo "<tr id=\"catoptr$cat->id\" >";
		 	echo "<td>$cat->id</td><td><input id=\"catop$cat->id\" value=\"".$cat->name."\"></input></td>";
		 	echo "<td><a href=\"javascript:edit_activity_category('".base_url()."',".$cat->id.")\"><span class=\"glyphicon glyphicon-pencil\"></span></a> <a href=\"javascript:delete_activity_category('".base_url()."',".$cat->id.")\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>";
		 	echo "</tr>";
		}
		?>
	</table>
	<div>
		<input type="text" id="new_activity_category"></input>
		<a class="btn btn-default" href="javascript:add_activity_category('<?php echo base_url()?>')">添加</a>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>