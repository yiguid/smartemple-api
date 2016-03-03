<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
<div class="container">
<?php $this->load->view('sidebar');?>
<div class="col-md-10">
	<h3><?php echo $zhongchou->title;?>
		<a href="<?php echo base_url('master/zhongchou');?>" class="btn btn-default">返回</a>
	</h3>
	<div class="form-line">
		<label for="endtime">结束时间：</label>
		<?php echo $zhongchou->endtime; ?>
	</div>
	<div class="form-line">
		<label for="countm">目标金额：<a class="btn btn-primary" href="<?php echo base_url().'master/zhongchou/donator/'.$zhongchou->id?>">查看所有捐助人</a> </label>
		<div class="progress progress-striped active">
	  		<!-- 条状显示百分比，最小宽度是8.6em，同时显示数字，现有金额和目标金额 -->
			<div class="progress-bar progress-bar-primary"
			 role="progressbar" style="width:<?php echo $total_money/$zhongchou->target*100;?>%;min-width:8.6em;"><?php echo $total_money."/".$zhongchou->target;?></div>
		</div>
	</div>
	<div class="form-line">
		<label for="content">内容：</label>
		<?php echo $zhongchou->content; ?>
	</div>
</form>
<label>奖励形式：</label>
<table class="table table-striped">
	<tr>
		<td>ID</td>
		<td>捐赠资金</td>
		<td>奖励</td>
		<td>编辑</td>
	</tr>
	<?php foreach($reward_list as $reward):?>  
	<tr>
		<td><?php echo $reward->id?></td>
		<td><?php echo $reward->money?></td>
		<td><?php echo $reward->award?></td>
		<td><a href="<?php echo base_url();?>master/reward/edit/<?php echo $zhongchou->id."/".$reward->id;?>" />
			<span class="glyphicon glyphicon-edit"></span></a> | <a href="<?php echo base_url();?>master/reward/delete/<?php echo $reward->id;?>" onclick="del_confirm()"/>
			<span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
	<?php endforeach;?>
</table>
<?php echo validation_errors(); ?>
	<form action='<?php echo base_url()."master/reward/add/".$zhongchou->id;?>' method='post' role="form">
	  <div class="form-line">
	    <input type="text" class="form-control" value=""  id="money" name="money" placeholder="捐赠资金">
	  </div>
	  <div class="form-line">
	    <input type="text" class="form-control" value=""  id="award" name="award" placeholder="奖励">
	  </div>
	  <div class="form-line">
	  	<button type="submit" class="btn btn-primary">添加</button> <a href="<?php echo base_url('master/zhongchou');?>" class="btn btn-default">返回</a>
		</div>
	</form>
</div>
</div>
</div>
<?php $this->load->view('footer');?>