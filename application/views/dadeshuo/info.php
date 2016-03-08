<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
?>
<div class="row" style="border-top:2px solid #938561;">

	<div class="container">	
		<?php foreach ($info as $q) 
			echo  $q." ";
	
	?></br>
	<?php foreach ($answer as $q) 
			echo  $q->realname.",".$q->avatar.",".$q->content;
	
	?>
	</div>
</div>
<?php $this->load->view('v1_footer');?>