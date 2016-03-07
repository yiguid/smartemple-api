<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/home/home_nav');
?>
<div class="main row">
<div class="container">
	<div><h3><?php echo $zhongchou->title;?></h3></div>
	<img src="<?php if($zhongchou->img != '') echo base_url().$zhongchou->img; else echo base_url('assets/images/donation2.jpg');?>" width="100%">
	<div>捐助金额：<?php echo $reward->money;?>元</div>
	<div>捐助时间：<?php echo $zhongchou_record->recordtime;?></div>
	<div>捐助回报：<?php echo $reward->award;?></div>
	<div>
		<?php switch($zhongchou_record->rewardstatus){
			case '未祈福': ;?>
			<form method="post" action="<?php echo base_url()."user/home/zhongchou_qf/$zhongchou_record->id"?>">
			<h3 class="text-danger">给师父的话</h3>
			<textarea rows="6" type="text" style="width:100%;" name="qf" placeholder="问题/祝福都可以"></textarea>
			<button class="btn btn-lg btn-primary" type="submit">送出</button>
			</form>
			<?php break;
			case '未领取': ;?>
			<button class="btn btn-danger btn-lg">请凭下面二维码找工作人员领取</button>
			<script type="text/javascript">
				setInterval("check_give()",2000);
				function check_give() {
					$.post("<?php echo base_url()?>user/home/check_give", {
						zhongchou_record_id : '<?php echo $zhongchou_record->id;?>'
					}, function(data) {
						if(data == true)
							location.reload();
					});
				}

			</script>
			<?php
			echo '<img src="'.$qrcode.'" />';
			?>
			<?php ;break;
			case '已领取': ;?>
			<button class="btn btn-danger btn-lg">已领取成功，功德无量。</button>
			<?php break;
		}?>
	</div>
	<span class="rt">
	<a class="btn btn-default" href="<?php echo base_url()."user/home/order"?>">返回</a>
	</span>
<!-- 	<div class="shide">
		<h3>欢迎报名参加活动和义工活动！</h3>
	</div> -->
</div>
</div>
<?php $this->load->view('wxshare_tail'); ?>
<?php $this->load->view('footer');?>
<?php if ($zhongchou_record->rewardstatus == '未祈福') { ?>
<script type="text/javascript">
if (typeof WeixinJSBridge == "undefined"){
    if( document.addEventListener ){
        document.addEventListener('WeixinJSBridgeReady', showShare, false);
    }else if (document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady', showShare); 
        document.attachEvent('onWeixinJSBridgeReady', showShare);
    }
    //showUrl();
}else{
    showShare();
}

function showShare(){
	$('body').prepend("<a href=\"javascript:hideScreen()\"><div id=\"share-screen\"><span style=\"float:right;\"><img width=\"300\" src=\"<?php echo base_url().'assets/images/fenx.png'?>\" /></span></div></a>");
	$('#share-screen').css({
	    "position": "absolute",
	    "background-color": "#000000",
	    "height": function () { return $(document).height(); },
	    "filter": "alpha(opacity=90)",
	    "opacity": "0.9",
	    "overflow": "hidden",
	    "width": function () { return $(document).width(); },
	    "z-index": "999"
	});
}

function showUrl(){
	$('body').prepend("<a href=\"javascript:hideScreen()\"><div id=\"share-screen\"><span style=\"float:right;\"><img width=\"300\" src=\"<?php echo base_url().'assets/images/fenx.png'?>\" /></span></div></a>");
	$('#share-screen').css({
	    "position": "absolute",
	    "background-color": "#000000",
	    "height": function () { return $(document).height(); },
	    "filter": "alpha(opacity=90)",
	    "opacity": "0.9",
	    "overflow": "hidden",
	    "width": function () { return $(document).width(); },
	    "z-index": "999"
	});
}

function hideScreen(){
	$('#share-screen').hide();
}

</script>
<?php } ?>