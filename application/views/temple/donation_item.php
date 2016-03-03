<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="main row">

<div class="container">
	<div class="alert alert-info" role="alert">
		<h3><?php echo $temple->name?></h3>
	</div>
	<div class="donation-item"><h3><?php echo $donation->name;?></h3></div>
	<div class="donation-item">类别：<?php echo $donation->type;?></div>
	<div class="donation-item">详情：<?php echo $donation->info;?></div>
	<div class="donation-item">单价：<?php echo $donation->price;?>元</div>
	<div class="donation-item">
		<span>捐助进度：</span>
		<div class="progress progress-striped active">
			<div class="progress-bar progress-bar-success"
			 role="progressbar" style="width:<?php echo $donation->soldcount/$donation->amount*100;?>%;min-width:4em;"><?php echo $donation->soldcount." / ".$donation->amount;?></div>
		</div>
	</div>
	<div class="donation-item"><img width="250" src="<?php if($donation->img != null) echo base_url().$donation->img; else echo base_url()."assets/images/jc1.jpg";?>"></div>
	<div class="donation-item donation-item-qrcode">
		<button class="btn btn-success" onclick="javasript:qrcode();">查看二维码</button>
		<button class="btn btn-danger" onclick="javasript:donation_contact_list();">查看供养名录</button>
		<div id="qrcode-img" style="display:none;">
			<?php
			echo '<img src="'.$donation_qrcode.'" />';
			?>
		</div>
		<div id="donation-contact-list" style="display:none;">
			<?php
			echo '供养名录<br/>';
			foreach ($donation_contact_list as $cl) {
				if($cl->contact != '0') //之前是!= 0，会有bug
					echo $cl->contact;
				else
					echo '匿名';
				echo "<br/>";
			}
			//var_dump($donation_contact_list);
			?>
		</div>
	</div>
	
	<div id="item-add">
		<a class="btn btn-info" href="javascript:item_add(<?php echo "'".$temple->id."','".$donation->id."','".base_url()."'"?>)">一键供养</a>
		<a class="btn btn-default" href="<?php echo base_url()."temple/id/".$temple->id?>">返回</a>
	</a>
	</div>
</div>
<?php $this->load->view('footer');?>