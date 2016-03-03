<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10 margin20">
		<div id="body">
			<table class="table table-striped">
			<tr>
				<td>ID</td>
				<td>标题</td>
				<td>结束时间</td>
				<td>目标金额</td>
				<td>操作</td>
			</tr>
		<?php foreach($zhongchou_list as $zhongchou):?>  
				<tr>
					<td><?php echo $zhongchou->id?></td>
					<td><?php echo $zhongchou->title?> <a class="btn btn-primary" href="<?php echo base_url();?>master/zhongchou/info/<?php echo $zhongchou->id?>">详细</a></td>
					<td><?php echo date('Y-m-d', strtotime($zhongchou->endtime))?></td>
					<td><?php echo $zhongchou->target?></td>
					<td><a href="<?php echo base_url();?>master/zhongchou/edit/<?php echo $zhongchou->id;?>" />
						<span class="glyphicon glyphicon-edit"></span></a> | <a href="<?php echo base_url();?>master/zhongchou/delete/<?php echo $zhongchou->id;?>" onclick="del_confirm()"/>
						<span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
		<?php endforeach;?>
		</table>
		
		<nav>
		<ul class="pagination">
			<?php 
			echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/zhongchou/$page_name/1\">首页</a></li>";
			if($cur_page != 1)
				echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/zhongchou/$page_name/".($cur_page - 1)."\">上一页</a></li>";
			for($i = 1; $i <= $total_page; $i++){
				$link = "<li";
				if($cur_page == $i)
					$link .= " class=\"active\"";
				echo $link."><a href=\"".base_url()."master/zhongchou/$page_name/$i\">$i</a></li>";
			}
			if($cur_page != $total_page)
				echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/zhongchou/$page_name/".($cur_page + 1)."\">下一页</a></li>";
    		echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/zhongchou/$page_name/$total_page\">尾页</a></li>"
			?>
		</ul>
		</nav>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>
