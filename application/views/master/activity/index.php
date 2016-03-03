<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10 margin20">
	<!-- <h3>禅修活动</h3> -->
	<div id="body">
		<table class="table table-striped">
			<tr>
				<td>ID</td>
				<td>标题</td>
				<td>报名情况</td>
				<td>操作</td>
			</tr>
		<?php foreach($activity_list as $activity):?>  
				<tr>
					<td><?php echo $activity->id?></td>
					<td><?php echo "<a href=\"".base_url()."master/activity/id/$activity->id\">".$activity->title."</a>"?></td>
					<td><a class="btn btn-primary" href="<?php echo base_url()."master/activity/id/".$activity->id?>">查看报名情况</a></td>
					<td><a href="<?php echo base_url();?>master/activity/edit/<?php echo $activity->id;?>" />编辑</a> | <a href="<?php echo base_url();?>master/activity/delete/<?php echo $activity->id;?>" onclick="del_confirm()"/>删除</a></td>
				</tr>
		<?php endforeach;?>
		</table>
		<div class="row manage form-line">

		<div class="col-md-4">
		</div>
		<div class="col-md-8" style="text-align:right">
			<form class="form-inline" role="form" action="<?php echo base_url();?>master/activity/search" method="post">
			<div class="form-group">
		    <input type="text" class="form-control" id="q" name="q" placeholder="请输入关键词">
		  	</div>
		  	<button type="submit" class="btn btn-default">搜索</button>
		  	<a href="<?php echo base_url();?>master/activity" class="btn btn-default">清空搜索条件</a>
		</form></div>
		</div>
		<nav>
		<ul class="pagination">
			<?php 
			echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/activity/$page_name/1\">首页</a></li>";
			if($cur_page != 1)
				echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/activity/$page_name/".($cur_page - 1)."\">上一页</a></li>";
			for($i = 1; $i <= $total_page; $i++){
				$link = "<li";
				if($cur_page == $i)
					$link .= " class=\"active\"";
				echo $link."><a href=\"".base_url()."master/activity/$page_name/$i\">$i</a></li>";
			}
			if($cur_page != $total_page)
				echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/activity/$page_name/".($cur_page + 1)."\">下一页</a></li>";
    		echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/activity/$page_name/$total_page\">尾页</a></li>"
			?>
		</ul>
		</nav>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>