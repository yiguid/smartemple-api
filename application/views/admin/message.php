<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
<div class="main row">
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>消息管理</h3>
	<div class="alert alert-info" role="alert">
		<a href="<?php echo base_url();?>admin/message/issue/1">发布</a>&nbsp;&nbsp;	
		<a href="<?php echo base_url();?>admin/message/type/1">发件箱</a>&nbsp;&nbsp;
		<a href="<?php echo base_url();?>admin/message/type/2">收件箱</a>	  
	</div>
	<?php if(isset($msg)) echo $msg;?>
	<table class="table table-striped">
		<th>ID</th><th><?php $url = base_url(); if($type == 2) echo '发件人'; else echo '收件人';?></th><th>内容</th><th>时间</th><th><?php if($type == 2) echo '操作';?></th>
		<?php foreach($message as $r):?> 		 
		<tr>
		<?php			
			echo "<td>".$r->id."</td><td>".$r->username.
			"</td><td>".$r->content."</td><td>".$r->time."</td>";
			if($type == 2)	
			echo "<td><a href='".$url."admin/message/issue/2/".$r->username."'>".回复."</a></td>";		
			else
			echo "<td></td>";							
		?>			
		</tr>  
	<?php endforeach;?> 
	</table>
</div>
</div>
</div>
<?php $this->load->view('footer');?>