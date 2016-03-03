<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/home/home_nav');
?>
<div class="main row">
<div class="container">
	<h4>留言记录</h4>
	<?php if(isset($msg)) echo $msg;?>
	<table class="table table-striped">
		<th>ID</th><th><?php $url = base_url(); echo '发件人';?></th><th>内容</th><th>时间</th><th><?php echo '操作';?></th>
		<?php foreach($qf_list as $r):?> 		 
		<tr>
		<?php			
			echo "<td>".$r->id."</td><td>".$r->username.
			"</td><td>".$r->content."</td><td>".$r->time."</td>			
			<td><a href='".$url."user/home/issue/".$r->username."'>回复&nbsp;&nbsp;&nbsp;&nbsp;</a>
			<a href='".$url."user/home/delete/".$r->id."' onclick='del_confirm()'>删除</a></td>";										
		?>			
		</tr>  
	<?php endforeach;?> 
	</table>
	<ul class="pagination">
			<?php 
			echo "<li class=\"pageinfo\"><a href=\"".base_url()."user/home/$page_name/1\">首页</a></li>";
			if($cur_page != 1)
				echo "<li class=\"pageinfo\"><a href=\"".base_url()."user/home/$page_name/".($cur_page - 1)."\">上一页</a></li>";
			for($i = 1; $i <= $total_page; $i++){
				$link = "<li";
				if($cur_page == $i)
					$link .= " class=\"active\"";
				echo $link."><a href=\"".base_url()."user/home/$page_name/$i\">$i</a></li>";
			}
			if($cur_page != $total_page)
				echo "<li class=\"pageinfo\"><a href=\"".base_url()."user/home/$page_name/".($cur_page + 1)."\">下一页</a></li>";
    		echo "<li class=\"pageinfo\"><a href=\"".base_url()."user/home/$page_name/$total_page\">尾页</a></li>"
			?>
		</ul>
</div>
</div>
<?php $this->load->view('footer');?>