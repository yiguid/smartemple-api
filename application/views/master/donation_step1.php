<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<ol class="breadcrumb">
	  <li class="active">选择供养物</li>
	  <li>填写供养人信息</li>
	  <li>供养信息确认</li>
	</ol>
	<div class="alert alert-info" role="alert">
		<h3>第一步 - 选择供养物</h3>
	</div>
	<table class="table table-striped">
		<th>名称</th><th>详细信息</th><th>价格</th><th>可供养数</th><th>数量</th><th>操作</th>
	<?php foreach($donation as $d):?>  
		<tr>
		<?php echo "<td>".$d->name ."</td><td>".substr($d->info, 0, 18)." <a target=\"_blank\" href=\"id/$d->id\"><span class=\"glyphicon glyphicon-info-sign glyphicon-big-sign\"></span></a>"."</td>"."<td>".$d->price."</td><td id=\"amount$d->id\">".($d->amount-$d->soldcount)."</td>";?>
		<td><input type="text" style="width:30px;" maxlength="4" id="soldcount<?php echo $d->id?>"></td>
		<td id="choose<?php echo $d->id?>"><a href="javascript:add_donation(<?php echo $d->id.",'".base_url()."'"; ?>)"><span class="glyphicon glyphicon-ok-sign glyphicon-big-sign"></span></a></td>
		</tr>  
	<?php endforeach;?>  
	</table>
	<a class="btn btn-success" href="step2"><h5>下一步</h5></a>
</div>
</div>
</div>
<?php $this->load->view('footer');?>