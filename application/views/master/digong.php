<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="row">	
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="main col-md-10">
	<div class="alert alert-info" role="alert">
		<h3><?php echo $temple->name?> - <small>已供奉3948个福位，总价值320万元。</small></h3>
	</div>
	<table class="table table-striped">
		<th>类型</th><th>永寿宫</th><th>永泰宫</th><th>永寿宫</th><th>永乐宫</th><th>永宁宫</th>
		<tr><th>形式</th><td>塔式</td><td>花园式</td><td>公寓式</td><td>四合院式</td><td>牌位式</td></tr>
		<tr><th>单价</th><td>10万</td><td>8万</td><td>3万</td><td>10万</td><td>8千</td></tr>
		<tr><th>总福位</th><td>100</td><td>300</td><td>500</td><td>300</td><td>100</td></tr>
		<tr><th>已供奉</th><td>50</td><td>129</td><td>300</td><td>200</td><td>70</td></tr>
	</table>
	
</div>
</div>
</div>

<?php $this->load->view('footer');?>