<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="main row">
<div class="container">
	<div class="alert alert-info" role="alert">
		<h3><?php echo $temple->name?></h3>
	</div>
	<form method="post" action="<?php echo base_url();?>donation/submit">
	<table class="table table-striped">
		<th>名称</th><th>详细信息</th><th>单价</th><th>总数</th><th>供养数</th>
	<?php foreach($donation as $d):?>  
		<tr>
		<?php echo "<td>".$d->name ."</td><td><a href=\"".base_url()."donation/item/$temple->id/$d->id\">$d->info</a></td><td>"
		.$d->price ."</td><td id=\"amount$d->id\">".($d->amount-$d->soldcount)."</td>";?>
		<td>
			<a href="javascript:count_minus('<?php echo $d->id?>')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
			<input type="text" style="width:30px;text-align:center;" value="0" maxlength="4" name="soldcount<?php echo $d->id?>" id="soldcount<?php echo $d->id?>">
			<a href="javascript:count_plus('<?php echo $d->id?>')"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
		</td>
		</tr>  
	<?php endforeach;?>  
	</table>
	<span class="rt">
	<button class="btn btn-success" type="submit">确认供养</button>
	<button class="btn btn-default" type="reset">全部重置</button>
	</span>
	</form>
</div>
</div>
<?php $this->load->view('footer');?>