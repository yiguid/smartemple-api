<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->ci =& get_instance();
$this->ci->load->view('v1_index_header');
?>
	<div id="container">
		<h3>页面没有找到</h3>
		<?php echo '点击logo看看其他内容吧'; ?>
	</div>
</div>
</div>
<?php $this->ci->load->view('v1_footer');?>