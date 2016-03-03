<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_index_header');
?>
		<div class="v1-index-content">
			<div class="panel-body">
				<div class="alert alert-success">
					<p><?php if(isset($register_info)) echo $register_info;?></p>
					<p><a href="<?php echo base_url('visit')?>">继续使用香客身份体验智慧供养</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('v1_footer');?>