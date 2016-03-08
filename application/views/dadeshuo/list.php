<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
?>
<div class="row" style="border-top:2px solid #938561;">

	<div class="container">	
		<?php foreach ($list as $q) {?>
		<a href="<?php echo base_url()."dds/question/info/$q->id";?>" class="v1-list-group-item">
			<div class="v1-list-news-item">
			<div class="v1-list-news-templename"><?php echo "[$q->datetime]";?></div>
			<div class="v1-list-news-title"><?php echo $q->content;?></div>
		</a>
			<div class="v1-list-news-date">&nbsp;&nbsp;&nbsp;&nbsp;赞：<?php echo $q->likes;?></div>
			<div class="v1-list-news-date">&nbsp;&nbsp;&nbsp;&nbsp;浏览：<?php echo $q->views;?></div>
			<div class="v1-list-news-date">&nbsp;&nbsp;&nbsp;&nbsp;回复：<?php echo $q->answer;?></div>
			</div>		
	<?php }
	?>
	</div>
</div>
<?php $this->load->view('v1_footer');?>