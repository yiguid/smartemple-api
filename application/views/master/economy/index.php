<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<div class="alert alert-info" role="alert">
		<h3>寺院经济</h3>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>