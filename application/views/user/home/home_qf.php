<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/home/home_nav');
?>
<div class="main row">
<div class="container">
	<h4>留言祈福记录</h4>
	<div class="v1-list-group">
	<?php foreach($qf as $q):?>
	<div class="label label-primary"><?php echo substr($q->userid, 0,30)?></div>
	<div class="alert alert-primary">
		<?php 
		echo "[ 来自".$q->location." ".$q->datetime." ]<br/>";
		echo '留言：'.$q->content;
		if ($q->donationcontent != '')
			echo "<p class=\"text-primary\">捐助：".$q->donationcontent."</p>";
		?>
		<br/>
		<?php
			if(isset($q->answer) && $q->answer != '') {
				echo "<div style=\"height: 36px;\"><div style=\"float:left;\" class=\"master-reply label-primary\">"
					.$q->master."：".$q->answer." [".$q->answer_datetime." ]";?> 
					<?php echo "</div></div>";
		?>
		<?php } ?>
	</div>
	<?php endforeach;?>
	</div>
</div>
</div>
<?php $this->load->view('footer');?>