<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/home/home_nav');
?>
<div class="main row">
<div class="container">		
		<form id="message-form" action="<?php echo base_url();?>user/home/data_issue" method="post">
		</p>		
		<label  for="username">To:</label>			
		<input  type="text" id="username" name="username" placeholder="收件人用户名" <?php echo  "value='$username' readonly";?> />
		</p>							
  		<script id="editor" type="text/plain" style="height:300px;"><?php if(isset($news)) echo $news->content; else echo set_value('content');?>
  		</script>
  		</p>
		<a href="javascript:get_ueditor_content()" class="btn btn-info btn-sm">
			<?php echo "发送";?>
		</a>					
		</p>
		</form>	
</div>
</div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/js/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/js/ueditor.all.min.js"> </script>
<script type="text/javascript">
	var ue = UE.getEditor('editor');
	function get_ueditor_content(){
		// $('#content').html(UE.getEditor('editor').getContent());
		// alert(UE.getEditor('editor').getContent());
		$('#message-form').submit();	
	}
</script>