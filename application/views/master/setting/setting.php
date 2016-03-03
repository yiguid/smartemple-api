<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<div class="alert alert-info" role="alert">
		<h3>寺院和法师介绍</h3>
		寺院和法师介绍将在首页通过链接形式展示：
		<?php echo form_open('master/setting/update_intro', array('class' => 'form-inline'));?>
		<input type="text" class="form-control" name="intro" id="intro" 
			value="<?php echo $temple->intro;?>"
			placeholder="寺院和法师介绍">
		<button type="submit" class="btn btn-info btn-sm">更新</button>
		</form>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>