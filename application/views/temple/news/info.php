<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="main row">
<div class="container">
	<?php $this->load->view('crumb')?>
	<div>
		<div><h2><?php echo $news->title?></h2></div>
		<div><p><?php echo $news->content?></p></div>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>