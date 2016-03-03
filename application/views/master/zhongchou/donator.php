<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3><?php echo $zhongchou->title;?>
		<a href="<?php echo base_url('master/zhongchou/info').'/'.$zhongchou->id;?>" class="btn btn-default">返回</a>
	</h3>
	<div class="form-line">
		<label for="endtime">结束时间：</label>
		<?php echo $zhongchou->endtime; ?>
	</div>
	<div class="form-line">
		<label for="countm">目标金额：</label>
		<div class="progress progress-striped active">
	  		<!-- 条状显示百分比，最小宽度是8.6em，同时显示数字，现有金额和目标金额 -->
			<div class="progress-bar progress-bar-primary"
			 role="progressbar" style="width:<?php echo $total_money/$zhongchou->target*100;?>%;min-width:8.6em;"><?php echo $total_money."/".$zhongchou->target;?></div>
		</div>
	</div>
	<div class="form-line">
		<?php foreach ($donator_list as $donator) { ?>
			<div class="v1-zhongchou-donator">
				<p><?php echo $donator->realname?>支持<?php echo $donator->money?>元，奖励<?php echo $donator->award?> <small class="rt"><?php echo $donator->recordtime?></small></p>
			</div>
		<?php }?>
	</div>
</form>
</div>
</div>
</div>
<?php $this->load->view('footer');?>