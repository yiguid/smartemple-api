<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">	
	<?php $this->load->view('sidebar');?>
	<div class="col-md-10">
	<div class="" role="alert">
		<h3><?php if(isset($volunteer)) echo $volunteer->title;?>
			<small><a href="<?php echo base_url();?>master/volunteer" class="btn btn-default">返回</a></small>
		</h3>
		<div class="form-line">
			日期：<?php if(isset($volunteer)) echo date('Y年m月d日', strtotime($volunteer->starttime)).' 至 '.date('Y年m月d日', strtotime($volunteer->endtime));?>
		</div>
		<div class="form-line">
			时间：<?php if(isset($volunteer)) echo date('h:i', strtotime($volunteer->starttime)).' - '.date('h:i', strtotime($volunteer->endtime));?>
		</div>
		<div class="form-line">
			地点：<?php if(isset($volunteer)) echo $volunteer->location;?>
		</div>
		<!-- <div class="form-line">
			活动形式：<?php if(isset($volunteer)) echo $volunteer->catname;?>
		</div> -->
		<div class="form-line">
			费用：<?php if(isset($volunteer)) echo $volunteer->cost;?>元/人
		</div>
		<div class="form-line">
			报名情况：
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-primary"
				 role="progressbar" style="width:<?php echo count($register_list)/$volunteer->capacity*100;?>%;min-width:6em;"><?php echo count($register_list)." / ".$volunteer->capacity;?></div>
			</div>
		</div>
		<div>
			<h3>已报名名单</h3>
			<table class="table table-striped">
				<th>报名时间</th><th>联系人</th><th>联系方式</th>
			<?php foreach ($register_list as $register) {
				echo "<tr><td>".$register->registertime."</td><td>".$register->applicant
				." <a class=\"btn btn-primary\" href=\"".base_url()."master/volunteer/show_answer/".$volunteer->id."/".$register->userid."\">查看报名表</a>"."</td><td>".$register->contact."</td></tr>";
			}?>
			</table>
		</div>
		<div class="form-line">
			内容：<?php if(isset($volunteer)) echo $volunteer->content;?>
		</div>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>