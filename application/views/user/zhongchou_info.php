<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>
<style type="text/css">

	.v1-banner-function{
		display: none;
	}

	.v1-nav{
		display: none;
	}

	.v1-banner{
		display: none;
	}

</style>

<div class="main row">
<div class="container">
	<div class="v1-page-news">
	<div class="v1-w75">
		<div><h3><?php echo $zhongchou->title?></h3>
		</div>
		<div class="v1-page-news-meta">
			<div class="v1-page-news-date">
				<?php echo "发布时间：".date('Y-m-d H:i:m', strtotime($zhongchou->inputtime));?>
			</div>
			<div class="v1-page-news-function">
				阅读 <?php echo $zhongchou->views?>
				<span style="padding-left:10px;"></span>
				<a href="javascript:ilike(<?php echo "'".base_url()."','zhongchou','".$zhongchou->id."'";?>)">
				<span id="ilike" class="glyphicon glyphicon-heart-empty">
				</span></a> <span id="ilike-count"><?php echo $zhongchou->like?></span>
			</div>
		</div>
		<div class="v1-page-zhongchou">
		<div class="v1-w50">
			<img src="<?php if($zhongchou->img != '') echo base_url().$zhongchou->img; else echo base_url('assets/images/donation2.jpg');?>" width="100%">
			<!-- <p><?php echo $zhongchou->description?></p> -->
			<div class="progress progress-striped active">
		  		<!-- 条状显示百分比，最小宽度是8.6em，同时显示数字，现有金额和目标金额 -->
				<div class="progress-bar progress-bar-danger"
				 role="progressbar" style="width:<?php echo $total_money/$zhongchou->target*100;?>%;min-width:8.6em;"><?php echo $total_money."/".$zhongchou->target;?></div>
			</div>
		</div>
		<div class="v1-w50">
			<div class="v1-zhongchou">
			<ul>
			<?php foreach ($reward_list as $reward) { ?>
				<li style="z-index:4">
					<div class="v1-zhongchou-item" >
						<div class="v1-w50">
							<p class=""><?php echo $reward->award?></p>
							<p class="">
							<!-- 根据reward id获取捐助支持的人数 data-toggle="modal" -->
							已有<?php echo $support_count[$reward->id]?>位支持者				  
							</p>
						</div>
						<div class="v1-w50 v1-zhongchou-item-btn">
							<a class="btn btn-danger btn-lg" onclick="javascript:zhongchou_login('<?php echo base_url();?>','<?php echo $this->session->userdata('id');?>','<?php echo $reward->id;?>')" href="#">
								<span id="support_price_100249990">
								支持<?php echo $reward->money?>元</span>
							</a>				
						</div>
						<div style="clear:both"></div>
					</div>
				</li>
			<?php }?>
			</ul>
			</div>
		</div>
		</div>
		<div class="v1-page-news-content"><p><?php echo $zhongchou->content?></p></div>
		<div class="v1-page-news-tail">

		</div>
	</div>
	<div class="v1-w25 margin20">
		<div class="v1-zhongchou-temple-info">
			<p>发起寺院：<?php echo $temple->name;?></p>
			<p>所在地：<?php echo $temple->province.$temple->city;?></p>
			<p>现任住持：<?php echo $temple->master;?></p>
			<p><a href="<?php echo base_url().'temple/route/'.$temple->id;?>" class="btn btn-primary">前往寺院主页</a></p>
		</div>
		<div class="v1-divider"></div>
		<div class="v1-donator-list">
		<?php foreach($donator_list as $donator):?>
				<div class="v1-zhongchou-donator">
					<!-- <p><?php echo $donator->realname?>捐助<?php echo $donator->money?>元 
						<span class="v1-donator-list-time"><?php echo $donator->recordtime?></span>
					</p> -->
					<div class="label label-primary board-username"><?php echo substr($donator->realname, 0,30)?></div>
					<div class="alert alert-default">
						<?php 
						echo "[ ".$donator->recordtime." ]<br/>"."捐助了".$donator->money."元。";
						?>
					</div> 
					<div style="clear:both"></div>
				</div>
		<?php endforeach;?>
		</div>
	</div>
	</div>
</div>
</div>
<?php $this->load->view('v1_footer');?>
<?php $this->load->view('login_with_mobile_modal');?>
<?php $this->load->view('alert_modal');?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
wx.config({

    debug: false,
    appId: '<?php echo $sign_package["appId"];?>',
    timestamp: <?php echo $sign_package["timestamp"];?>,
    nonceStr: '<?php echo $sign_package["nonceStr"];?>',
    signature: '<?php echo $sign_package["signature"];?>',
    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage']

});

wx.ready(function () {
// 在这里调用 API
// 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
    wx.onMenuShareTimeline({
        title: '<?php echo $share_title;?>', // 分享标题
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>" // 分享图标
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