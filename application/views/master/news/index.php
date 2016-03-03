<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10 margin20">
	<div id="body">
		<table class="table table-striped">
			<tr>
				<td>ID</td>
				<td>标题</td>
				<td>发布日期</td>
				<td>操作</td>
			</tr>
		<?php foreach($news_list as $news):?>  
				<tr>
					<td><?php echo $news->id?></td>
					<td><?php echo $news->title?></td>
					<td><?php echo $news->inputtime?></td>
					<td><a href="<?php echo base_url();?>master/news/edit/<?php echo $news->id;?>" />编辑</a> | <a href="<?php echo base_url();?>master/news/delete/<?php echo $news->id;?>" onclick="del_confirm()"/>删除</a></td>
				</tr>
		<?php endforeach;?>
		</table>
		<div class="row manage form-line">
		
		<div class="col-md-4">
		</div>
		<div class="col-md-8" style="text-align:right;">
			<form class="form-inline" role="form" action="<?php echo base_url();?>master/news/search" method="post">
			<div class="form-group">
		    <input type="text" class="form-control" id="q" name="q" placeholder="请输入关键词">
		  	</div>
		  	<button type="submit" class="btn btn-default">搜索</button>
		  	<a href="<?php echo base_url();?>master/news" class="btn btn-default">清空搜索条件</a>
		</form></div>
		</div>
		<nav>
		<ul class="pagination">
			<?php 
			echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/news/$page_name/1\">首页</a></li>";
			if($cur_page != 1)
				echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/news/$page_name/".($cur_page - 1)."\">上一页</a></li>";
			for($i = 1; $i <= $total_page; $i++){
				$link = "<li";
				if($cur_page == $i)
					$link .= " class=\"active\"";
				echo $link."><a href=\"".base_url()."master/news/$page_name/$i\">$i</a></li>";
			}
			if($cur_page != $total_page)
				echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/news/$page_name/".($cur_page + 1)."\">下一页</a></li>";
    		echo "<li class=\"pageinfo\"><a href=\"".base_url()."master/news/$page_name/$total_page\">尾页</a></li>"
			?>
		</ul>
		</nav>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>