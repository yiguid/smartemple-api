<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>
<div class="main row">
<div class="container">
	<div class="v1-page-news">
		<div><h3><?php echo $activity->title?></h3></div>
		<!-- <div class="form-line">活动形式：<?php echo $activity->catname?></div> -->
		<div class="v1-page-news-function">
			阅读 <?php echo $activity->views?>
			<span style="padding-left:10px;"></span>
			<a href="javascript:ilike(<?php echo "'".base_url()."','activity','".$activity->id."'";?>)">
			<span id="ilike" class="glyphicon glyphicon-heart-empty">
			</span></a> <span id="ilike-count"><?php echo $activity->like?></span>
		</div>
		<div class="form-line v1-activity-time">日期：<?php if(isset($activity)) echo date('Y年m月d日', strtotime($activity->starttime)).' 至 '.date('Y年m月d日', strtotime($activity->endtime));?></div>
		<div class="form-line v1-activity-time">时间：<?php if(isset($activity)) echo date('H:i', strtotime($activity->starttime)).' - '.date('H:i', strtotime($activity->endtime));?></div>
		<div class="form-line v1-activity-time">地点：<?php if(isset($activity)) echo $activity->location;?></div>
		<div class="form-line v1-activity-time">费用：<?php if($activity->cost > 0) echo $activity->cost."元/人"; else echo '随喜';?>
		</div>
		<div class="form-line v1-activity-cost">
		报名情况：
			<div class="progress" style="max-width:500px;">
				<div class="progress-bar progress-bar-primary"
				 role="progressbar" style="width:<?php echo count($register_list)/$activity->capacity*100;?>%;min-width:6em;line-height:20px;"><?php echo count($register_list)." / ".$activity->capacity;?></div>
			</div>
		</div>
		<div style="margin-top:10px;">
		<?php if(!$is_register && count($register_list) < $activity->capacity){?>
		<a href="#" onclick="javascript:check_login('<?php echo base_url();?>','<?php echo $this->session->userdata('id');?>','<?php echo $this->session->userdata('userdetail');?>')" class="btn btn-danger" data-target="#regist-form" >我要报名</a>
		<?php }else if($is_register){ ?>
		<button class="btn btn-primary"  data-toggle="modal" data-target=".bs-example-modal-sm">已报名</button>
		<?php }else{ ?>
		<a href="#" class="btn btn-primary" data-target="#regist-form" >报名已满</a>
		<?php }?>
		</div>
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		    	<div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		          <h4 class="modal-title" id="mySmallModalLabel">报名情况</h4>
		        </div>
		        <div class="modal-body">
		          <a class="btn btn-primary" href="<?php echo base_url()."user/home/activity"?>">查看所有已报名活动</a>
		          <a class="btn btn-default" onclick="javascript:quit_confirm()" href="<?php echo base_url()."user/activity/quit/".$activity->id?>">取消报名</a>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
		<div  style="border-bottom:1px solid #ccc;padding-bottom:10px;">
		<h3>已报名名单</h3>
		<?php foreach ($register_list as $register) {
			echo "<span class=\"btn btn-default\">".$register->applicant."</span>";
		}?>
		</div>
		<div class="v1-page-news-content"><p><?php echo $activity->content?></p></div>
	<div class="modal fade" id="regist-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">报名信息</h4>
	      </div>
	      <form action="<?php echo base_url().'user/activity/register/'.$activity->hostid."/".$activity->id;?>" method="post">
	      <div class="modal-body">
	          <div class="form-group">
	            <label for="applicant" class="control-label">真实姓名</label>
	            <input type="text" class="form-control" id="applicant" name="applicant" value="<?php echo $this->session->userdata('realname')?>">
	          </div>
	          <div class="form-group">
	            <label for="contact" class="control-label">联系方式</label>
	            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $this->session->userdata('username')?>">
	          </div>
	         <!--  <div class="form-group">
	            <label for="remark" class="control-label">备注</label>
	            <textarea class="form-control" id="remark" name="remark"></textarea>
	          </div> -->
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
	        <button type="submit" class="btn btn-primary">报名</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
	</div>
</div>
</div>
<?php $this->load->view('v1_footer');?>

<?php $this->load->view('alert_modal');?>
<?php $this->load->view('login_modal');?>
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