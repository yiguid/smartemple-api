<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>
<div class="main row">
<div class="container">
	<div class="v1-list-group">
	<?php foreach ($roll_list as $roll) {?>
		<a href="<?php echo base_url()."temple/id/$roll->templeid";?>" class="v1-list-group-item">
			<div class="v1-list-news-item">
			<div class="v1-list-news-templename"><?php echo "[".($roll->templename!=''?$roll->templename:'智慧寺院')."]";?></div>
			<div class="v1-list-news-title"><?php echo $roll->contact.'捐助'.$roll->total.'元';?></div>
			<div class="v1-list-news-date"><?php echo date('Y-m-d', strtotime($roll->ordertime));?></div>
			</div>
		</a>
	<?php }?>
	</div>
	<?php
		//if(count($news_list) == 15)
		echo "<a href=\"javascript:more('".base_url()."','donation')\" class=\"btn btn-default btn-block\" id=\"more\">查看更多</a>"; 
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
			<?php echo "more('".base_url()."','donation');";?>
		}, 500);
      }  
  });  
});  

</script>