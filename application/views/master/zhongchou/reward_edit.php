<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3>编辑奖励</h3>
	<?php echo validation_errors(); ?>
	<form action='<?php echo base_url()."master/reward/edit/".$zhongchouid."/".$reward->id;?>' method='post' role="form">
	  <div class="form-line">
	    <input type="text" class="form-control" value="<?php if(isset($reward)) echo $reward->money;?>"  id="money" name="money" placeholder="捐赠资金">
	  </div>
	  <div class="form-line">
	    <input type="text" class="form-control" value="<?php if(isset($reward)) echo $reward->award;?>"  id="award" name="award" placeholder="奖励">
	  </div>
	  <div class="form-line">
	  	<button type="submit" class="btn btn-primary">保存</button> <a href="<?php echo base_url('master/zhongchou');?>" class="btn btn-default">返回</a>
		</div>
	</form>
</div>
</div>
</div>
<?php $this->load->view('footer');?>