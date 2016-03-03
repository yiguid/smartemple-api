<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>
<div class="row" style="border-top:2px solid #938561;">
	<div class="container">
		<?php $num=1;foreach ($news_stick as $stick) {?>
			<a href="<?php echo base_url()."user/news/id/".$stick->id;?>">
			<div class="v1-fl v1-w25 v1-focus-news-item v1-list-stick v1-news-stick-bg<?php echo $num?>">
				<div class="v1-focus-news-item-title">[<?php echo $stick->templename;?>]</div>
				<div class="v1-focus-news-item-content"><?php echo $stick->title;?></div>
				<div class="v1-focus-news-item-more">阅读更多 >></div>	
			</div>
			</a>
		<?php $num++;}?>
	</div>
</div>

<div class="row">
<div class="container">
	<div class="v1-list-group">
	<?php foreach ($news_list as $news) {?>
		<a href="<?php echo base_url()."user/news/id/$news->id";?>" class="v1-list-group-item">
			<div class="v1-list-news-item">
			<div class="v1-list-news-templename"><?php echo "[".($news->templename!=''?$news->templename:'智慧寺院')."]";?></div>
			<div class="v1-list-news-title"><?php echo $news->title;?></div>
			<div class="v1-list-news-date"><?php echo date('Y-m-d', strtotime($news->inputtime));?></div>
			</div>
		</a>
	<?php }
	?>
	</div>
	<?php
		//if(count($news_list) == 15)
		echo "<a href=\"javascript:more('".base_url()."','news')\" class=\"btn btn-default btn-block\" id=\"more\">查看更多</a>"; 
	?>
</div>
</div>
<?php $this->load->view('v1_footer');?>

<script type="text/javascript">

var loading = false;
$(function(){  
  $(window).scroll(function() {  
      //当内容滚动到底部时加载新的内容  
      if ($(this).scrollTop() + $(window).height()>= $(document).height() && !loading) {
          //当前要加载的页码
        //alert(loading);
		loading = true;
		setTimeout(function () { 
			<?php echo "more('".base_url()."','news');";?>
		}, 500);
      }  
  });  
});  

</script>