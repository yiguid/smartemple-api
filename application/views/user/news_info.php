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
			<?php echo "发布时间：".date('Y-m-d h:i:m', strtotime($news->inputtime));?>
		</div>
		<div class="v1-page-news-function">
			阅读 <?php echo $news->views?>
			<span style="padding-left:10px;"></span>
			<a href="javascript:ilike(<?php echo "'".base_url()."','news','".$news->id."'";?>)">
			<span id="ilike" class="glyphicon glyphicon-heart-empty">
			</span></a> <span id="ilike-count"><?php echo $news->like?></span>
		</div>
		</div>
		<div><p><?php echo $news->content?></p></div>
		<div class="v1-page-news-tail">

		</div>
	</div>
</div>
</div>
<?php $this->load->view('v1_footer');?>