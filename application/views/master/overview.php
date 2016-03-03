<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="main row">	
	<div class="container">
	<h3>寺院概况</h3>
	<table class="table table-striped">
		<th>ID</th><th>寺院名称</th><th>寺院英文名</th><th>地理位置</th><th>住持方丈</th>
		<tr>
			<?php echo "<td>".$temple->id ."</td><td>".$temple->name ."</td><td>".$temple->englishname  ."</td><td>".$temple->province.$temple->city ."</td><td>".$temple->master  ."</td>";?>
		</tr>
	</table>
	<table class="table table-striped">
		<th>项目</th><th>福位数</th><th>供养数</th><th>祈福数</th>
		<tr>
			<?php echo "<td>".$temple->name ."</td><td>".$space ."</td><td>".$donation  ."</td><td>".$qf."</td>";?>
		</tr>
	</table>
</div>
</div>
<?php $this->load->view('footer');?>