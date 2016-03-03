<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('nav');
?>
<div class="main row">
	<h3 class="text-success">如何在祈福墙发言</h3>
	<div class="row">
	  <div class="col-md-6">
	  	<div class="panel panel-success">
	        <div class="panel-heading">
	          <h3 class="panel-title">第一步：拿出手机关注“智慧寺院”</h3>
	        </div>
	        <div class="panel-body">
	          <b>公众账号：smartemple或者扫描右边的二维码→_→</b>
	        </div>
	    </div>
	    <div class="panel panel-success">
	        <div class="panel-heading">
	          <h3 class="panel-title">第二步：提交你的微信号和昵称</h3>
	        </div>
	        <div class="panel-body">
	          <b>发送：m 你的微信号 你想要的昵称，如“m account 明德”<br/>不要忘记空格噢！~</b>
	        </div>
	    </div>
	    <div class="panel panel-success">
	        <div class="panel-heading">
	          <h3 class="panel-title">第三步：说出你想说的话吧</h3>
	        </div>
	        <div class="panel-body">
	          <b>发送：q 你想说的话，如“q 我也上墙啦！”</b>
	        </div>
	    </div>
	  </div>
	  <div class="col-md-6"><img class="img-thumbnail" src="<?php echo base_url(); ?>assets/images/qrcode.jpg"/></div>
	</div>
	<h3>看看大家都在说什么</h3>
	<div class="row">
	  <div id="wall" class="col-md-12">
	  	<?php $type = array('success','info','warning','danger');?>
        <?php foreach($history as $his):?> 
        <?php $color = $type[array_rand($type)];?>
		<div class="label label-<?php echo $color;?> wall-username"><?php echo $his->username?></div>
		<div class="alert alert-<?php echo $color;?>"><?php echo $his->msg ." ( ".$his->datetime." )" ?></div>  
		<?php endforeach;?>  
	  </div>
	</div>
</div>

<script type="text/javascript">
	function getNewLine()
	{
		$.ajax({
			url:'<?php echo base_url(); ?>weixin/getNewChathistory',
			type:'GET',
			success:function(data){
				$('#wall').prepend(data);
				$('div').fadeIn(3000);
			}
		});
	}

	setInterval(function(){getNewLine();},5000);
</script>

<?php $this->load->view('footer');?>
