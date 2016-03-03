<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('admin/v1_admin_nav');
?>
		<div class="main row">	
		<div class="container">
		<?php $this->load->view('sidebar');?>	
		<div class="col-md-10">			
		<form id="message-form" action="<?php echo base_url();?>admin/message/data_issue" method="post">
		</p>
		<div style="height:170px;">
			<label  for="username">To:</label>			
		    <input  type="text" id="username" name="username" placeholder="收件人用户名" <?php if($type == 2) echo  "value='$username' readonly";?> />	
		</div>				
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
<link href="<?php echo base_url();?>assets/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.4.custom.js"></script>

<script type="text/javascript">
$(function(){	
	$( "#username" ).autocomplete({
		source: "<?php echo base_url()."admin/message/ajax_issue"?>",
		minLength: 1,	
	});
});
</script>