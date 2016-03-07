<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>
<div class="main row">
<div class="container">
	<div class="v1-page-news">
		<div><h3><?php echo $news->title?></h3>
		</div>
		<div class="v1-page-news-meta">
		<div class="v1-page-news-date">
			<?php echo "发布时间：".date('m-d h:i', strtotime($news->inputtime));?>
		</div>
		<div class="v1-page-news-function">
			阅读 <?php echo $news->views?>
			<span style="padding-left:10px;"></span>
			<a href="javascript:ilike(<?php echo "'".base_url()."','news','".$news->id."'";?>)">
			<span id="ilike" class="glyphicon glyphicon-heart-empty">
			</span></a> <span id="ilike-count"><?php echo $news->like?></span>
		</div>
		</div>
		<div class="v1-page-news-content"><p><?php echo $news->content?></p></div>
        <?php if($news->hasdonation) { ?>
        <div class="ffs-block">
            <a style="color:white;text-decoration:none;" href="<?php echo base_url().'temple/daily/'.$temple->id;?>">
            <div class="syxj-title xj xj3"><?php echo $temple->name;?>日行一善</div>
            <div class="ffs-slogan"><p>点击完成日行一善</p>
                <div class="text-center"><button class="btn btn-primary"><?php echo "总计参与人数".round($donation_info->count)?>人</button><button class="btn btn-danger"><?php echo "已募集善款".round($donation_info->income)?>元</button></div>
            </div>
            </a>
        </div>
        <div class="ffs-block">
            <div class="syxj-title xj xj4"><?php echo $temple->name;?>捐助方式</div>
            <div class="ffs-slogan"><p>您可以在线选择物品供养或者到寺院完成供养。</p><?php echo $temple->contacts;?></div>
        </div>
        <?php } ?>
		<div class="v1-page-news-tail">

		</div>
	</div>
</div>
</div>
<?php $this->load->view('v1_footer');?>
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