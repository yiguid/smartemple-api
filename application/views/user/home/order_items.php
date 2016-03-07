<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('user/home/home_nav');
?>
<div class="main row">
<div class="container">
	<?php echo form_open('qf/add','class="form-horizontal" ');?>
	 <div class="form-group col-md-12">
		<input type="hidden" class="form-control" name="userid" id="userid" 
			<?php if($this->session->userdata('realname') != null) echo 'value="'.$this->session->userdata('realname').'"';?>/>
		<div class="col-sm-12"><h3 class="shide">您可以留祝福或问题给法师：</h3></div>
		<div class="col-sm-12"><textarea class="form-control" rows="3" name="content" id="content"></textarea></div>
	<div class="form-group col-md-12">
	</div>
		<div class="col-sm-10"><button type="submit" class="btn btn-danger btn-lg">发送</button></div>
	</div> 
	<?php echo form_close();?>

	<div class="shide">
		<h5>十德</h5>
		<p>消灭怨结，断除业障。天人护佑，逢凶化吉。</p><p>去除障碍，免夙怨苦。妖魔邪怪，不能侵犯。</p>
		<p>脱离烦恼，破除无明。丰衣足食，福禄绵长。</p><p>所言所行，人天欢喜。福慧二资，俱得增长。</p>
		<p>往生善道，相貌端庄。往生极乐，速证解脱。</p>
		<h5>五利</h5>
		<p>身相端庄 气力增盛 寿命延长 快乐安稳 成就辩才</p>
	</div>

	

	<table class="table table-striped">
		<th>供养编号： <?php echo $order->id;?></th>
	</table>
	<table class="table table-striped">
		<th>供养时间</th><th>金额</th><th>状态</th>
		<tr>
		<?php echo "<td>".$order->ordertime ."</td><td>".$order->total ."</td><td>".$order->status."</td>";?>
		</tr>  
	</table>
	<table class="table table-striped">
		<th>物品</th><th>数量</th><th>详细信息</th><th>单价</th>
		<?php foreach($order_items as $item):?>  
		<tr>
		<?php echo "<td>".$item->name ."</td><td>".$item->count ."</td><td>".$item->info ."</td><td>".$item->price."</td>";?>
		</tr>  
		<?php endforeach;?>  
	</table>
	
	<span class="rt">
	<?php if($order->status == '未支付'){ ?>
		<a href="<?php echo base_url()."alipay/pay/".$order->id;?>" class="btn btn-success">继续支付</a>
	<?php }?>
	<a class="btn btn-default" href="<?php echo base_url()."user/home/order"?>">返回</a>
	</span>
</div>
</div>
<?php $this->load->view('footer');?>

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
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
        success: function () { 
	        // 用户确认分享后执行的回调函数
	        hideScreen();
    	}
    });
    // 获取“分享给朋友”按钮点击状态及自定义分享内容接口
    wx.onMenuShareAppMessage({
        title: '<?php echo $share_title;?>', // 分享标题
        desc: "<?php echo $share_desc;?>", // 分享描述
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
        type: 'link', // 分享类型,music、video或link，不填默认为link
        success: function () { 
	        // 用户确认分享后执行的回调函数
	        hideScreen();
    	}
    });

    wx.onMenuShareQQ({
        title: '<?php echo $share_title;?>', // 分享标题
        desc: "<?php echo $share_desc;?>", // 分享描述
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
        success: function () { 
	        // 用户确认分享后执行的回调函数
	        hideScreen();
    	}
    });

    wx.onMenuShareWeibo({
        title: '<?php echo $share_title;?>', // 分享标题
        desc: "<?php echo $share_desc;?>", // 分享描述
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
        success: function () { 
	        // 用户确认分享后执行的回调函数
	        hideScreen();
    	}
    });

    wx.onMenuShareQZone({
        title: '<?php echo $share_title;?>', // 分享标题
        desc: "<?php echo $share_desc;?>", // 分享描述
        link: "<?php echo $share_link;?>",
        imgUrl: "<?php echo base_url().$share_img;?>", // 分享图标
        success: function () { 
	        // 用户确认分享后执行的回调函数
	        hideScreen();
    	}
    });
});
</script>