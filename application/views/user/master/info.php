<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>
<style type="text/css">

	.v1-top{
		display: none;
	}

	.v1-banner{
		display: none;
	}

	.v1-nav{
		display: none;
	}
	
	.verified-mark{
		width: 40px !important;
		position: absolute;
		top: 14px;
		padding-left: 4px;
	}

</style>
<div class="row" style="border-top:2px solid #938561;">

	<div class="container">
		<div class="v1-page-master">
		<div class="v1-fl v1-w100">
			<h3>
				<?php echo $master->realname;?>
				<img class="verified-mark" src="<?php echo base_url()."assets/images/".($master->verified==0?"not":"master")."-verified.png";?>" />
			</h3>
			<div class="v1-page-news-function">
				人气 <?php echo $master->views?>
				<span style="padding-left:10px;"></span>
				<a href="javascript:ilike(<?php echo "'".base_url()."','master','".$master->id."'";?>)">
				<span id="ilike" class="glyphicon glyphicon-heart-empty">
				</span></a> <span id="ilike-count"><?php echo $master->likes?></span>
			</div>
			<div>
			<div class="v1-fl v1-w75 text-center">
				<a id="downloadVoice" href="#">
				<style type="text/css">
					.v1-page-master-img{
						width:200px;height:200px;border-radius:100px;border:6px solid #DAC694;
						margin-bottom: 10px;
					}
					.master-info li{
						width: 50%;
						text-align: center;
					}
				</style>
				<img class="v1-page-master-img" src="<?php echo base_url().($master->avatar == ''?"assets/images/fashi-small.jpg":$master->avatar);?>" />
				</a>
			</div>
			<div class="v1-fl v1-w25">
				<div class="">
					<h4 class="text-center"><?php echo $temple->province.$temple->city;?><?php echo $temple->name;?>
					<br/><small><a href="<?php echo base_url().'temple/route/'.$temple->id;?>" class="">访问寺院主页</a></small></h4>
					<!-- <p>法师简介：<?php echo $master->intro?></p> -->
					<p><a href="<?php echo base_url().'voice/temple/'.$temple->id;?>" class="btn btn-primary btn-block btn-lg">查看今日语音开示</a></p>
					<!-- <p><a href="<?php echo base_url().'temple/daily/'.$temple->id;?>" class="btn btn-primary">点击前往<?php echo $temple->name;?>日行一善</a></p>
					<h4 id="info"></h4> -->
				</div>
			</div>
			</div>
		</div>

		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs master-info" role="tablist">
		    <li role="presentation" class="active"><a href="#timeline" aria-controls="messages" role="tab" data-toggle="tab">时光轴</a></li>
		    <li role="presentation"><a href="#qa" aria-controls="profile" role="tab" data-toggle="tab">问答</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="timeline">
		    	<div class="v1-w15 timeline-year">
		    		<?php foreach($timeline_years as $year => $months):?>
		    			<div>
		    			<a class="btn btn-primary timeline-year" href="javascript:jump('year-<?php echo $year;?>')"><?php echo $year;?>年</a>
		    			<?php foreach($months as $month):?>
		    				<a class="btn btn-default timeline-month" href="javascript:jump('year-<?php echo $year;?>')"><?php echo $month;?>月</a>
		    			<?php endforeach;?>
		    			</div>
					<?php endforeach;?>
		    	</div>
		    	<div class="v1-w85 timeline-list">
		    		<?php
		    		$year_pos = 0; 
		    		foreach($timeline as $tl):?>
					<?php 
					$year = date('Y', strtotime($tl->datetime));
					if($year != $year_pos) { ?>
						<div class="timeline-year-position btn btn-danger" id="year-<?php echo $year?>"><?php echo $year; $year_pos = $year?>年</div>
					<?php } ?>
			    	<div class="timeline">
						<div class="timeline-datetime v1-w100">
							<?php echo date('m月d日', strtotime($tl->datetime))?>
						</div>
						<div class="timeline-img">
							<a href="javascript:playVoice('<?php echo $tl->voiceServerId?>')">
							<?php
							if($tl->img != '')
								echo "<img src=\"".base_url()."$tl->img\"/>";
							else
								echo "<img src=\"".base_url()."assets/images/shida".rand(1,10).".png\"/>";
							?>
							</a>
						</div>
						<div class="timeline-message">
							<?php 
							echo $tl->message;
							if($tl->link != '')
								echo "<br/><a href=\"".$tl->link."\">查看详情 >></a>";
							if($tl->voiceServerId != '')
								echo "<br/><span class=\"text-danger\">[语音消息，请点击左图收听]</span>";
							?>


						</div>
						<div style="clear:both"></div>
					</div>
					<?php endforeach;?>
				</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="qa">
		    	<?php foreach ($qa as $w) {?>
				<div class="text-left" style="line-height:30px; border-bottom:1px solid #efefef; padding:0 4px;">
					<a href="<?php echo base_url()."qf/temple/".$temple->id?>">
						<?php 
							echo "<span style=\"font-size:18px; font-weight:bold;\">问</span>：".$w->question;
							echo "<br />";
							echo "<span style=\"font-size:18px; font-weight:bold; color:#b12029;\">答</span>：<span style=\"color:#b12029;\">".$w->answer."</span>";
						?>
					</a>
				</div>
				<?php }?>
			</div>
			
		  </div>
		</div>
		<div>
			<button class="btn btn-block btn-danger btn-lg">祈福墙</button>
	    	<marquee direction="up" scrollamount="1" width="100%" height="180px" onmouseover="this.stop()" onmouseout="this.start()" style="height: 180px; width: 100%;">
			<?php foreach ($wish as $w) {?>
			<div class="temple-wish-item">
				<a href="<?php echo base_url()."qf/temple/".$temple->id?>">
					<?php 
						echo '['.$w->datetime.']';
						if(mb_substr($w->location, 0, 2) == mb_substr($w->userid, 0, 2))
							echo $w->userid."：".$w->content;
						else
							echo $w->location.$w->userid."：".$w->content;
					?>
				</a>
			</div>
			<?php }?>
			</marquee>
	    </div>
		<div>
			<?php if($this->session->userdata('realname') == null) { ?>
				<p>登录后可以留下问答或祈福</p>
				<p><a class="btn btn-primary btn-lg btn-block" href="<?php echo base_url()?>login">登录</a></p>
				<p><a class="btn btn-success btn-lg btn-block" href="<?php echo base_url('wxlogin')?>">微信登录</a></p>
			<?php } else { ?>
			<?php echo form_open('user/master/qf/'.$master->id.'/'.$temple->id,'class="form-horizontal" ');?>
			<div class="form-group col-md-12">
				<div class="col-sm-12"><label for="userid">昵称：</label></div>
				<div class="col-sm-12">
					<input type="text" class="form-control" name="userid" id="userid" 
					<?php if($this->session->userdata('realname') != null) echo 'value="'.$this->session->userdata('realname').'"';?>/>
				</div>
			<div class="form-group col-md-12">
			</div>
				<div class="col-sm-12"><label for="userid">内容：</label></div>
				<div class="col-sm-12"><textarea class="form-control" rows="3" name="content" id="content"></textarea></div>
			<div class="form-group col-md-12">
			</div>
				<div class="col-sm-10"><button type="submit" class="btn btn-primary btn-lg btn-block">祈福</button></div>
			</div>
			<?php echo form_close();?>
			<?php } ?>
		</div>
		</div>
	</div>
</div>

<?php $this->load->view('v1_footer');?>
<script type="text/javascript">
	function jump(tag) {
		$("html,body").animate({scrollTop:$('#'+tag).offset().top},1000);
	}
</script>

<script type="text/javascript">
	$(function() { 
	    // $.get('update.php?id=1',{r:Math.random()});
	    $.post('<?php echo base_url();?>' + "user/master/iviews", {
			id : <?php echo $master->id;?>,
			r : Math.random()
		}, function(data) {
			
		}); 
	    //当然$.post()、$.ajax()等都可以咯。 
	    //然后要记得加一个随机数，因为如果不加的话，有的浏览器会认为是同一个请求，然后不请求。
	});
</script>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
wx.config({

    debug: false,
    appId: '<?php echo $sign_package["appId"];?>',
    timestamp: <?php echo $sign_package["timestamp"];?>,
    nonceStr: '<?php echo $sign_package["nonceStr"];?>',
    signature: '<?php echo $sign_package["signature"];?>',
    jsApiList: ['onMenuShareTimeline',
        'onMenuShareAppMessage',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'onVoicePlayEnd',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice']
});
var voice = {
    localId: '',
    serverId: ''
  };


function playVoice(serverId){
  voice.serverId = serverId;
  // $('#info').html('获取服务器录音，Id：' + voice.serverId);
  $('#downloadVoice').click();
  // $('#playVoice').click();
}

wx.ready(function () {
// 在这里调用 API

  wx.onVoicePlayEnd({
    complete: function (res) {
      // $('#info').html('播放完毕，本地id：' + res.localId);
    }
  });

  document.querySelector('#downloadVoice').onclick = function () {
    if (voice.serverId == '') {
      // $('#info').html('请先上传语音');
      return;
    }
    wx.downloadVoice({
      serverId: voice.serverId,
      success: function (res) {
        // $('#info').html('下载到本地，id：' + res.localId);
        voice.localId = res.localId;
        wx.playVoice({
          localId: voice.localId
        });
      }
    });
  };


// 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
    wx.onMenuShareTimeline({
        title: '<?php echo $share_title;?>', // 分享标题
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
    });
    // 获取“分享给朋友”按钮点击状态及自定义分享内容接口
    wx.onMenuShareAppMessage({
        title: '<?php echo $share_title;?>', // 分享标题
        desc: "<?php echo $share_desc;?>", // 分享描述
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
        type: 'link', // 分享类型,music、video或link，不填默认为link
    });

    wx.onMenuShareQQ({
        title: '<?php echo $share_title;?>', // 分享标题
        desc: "<?php echo $share_desc;?>", // 分享描述
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
    });

    wx.onMenuShareWeibo({
        title: '<?php echo $share_title;?>', // 分享标题
        desc: "<?php echo $share_desc;?>", // 分享描述
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
    });

    wx.onMenuShareQZone({
        title: '<?php echo $share_title;?>', // 分享标题
        desc: "<?php echo $share_desc;?>", // 分享描述
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
    });
});
</script>
<?php $this->load->view('share_to_cellphone'); ?>