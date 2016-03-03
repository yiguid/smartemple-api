<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/v1-style.css">
<div class="row v1-focus">
	<div class="container">
		<?php if($temple->planimg != '')?>
			<img src="<?php echo base_url().$temple->homeimg?>" width="100%">
		<div class="v1-qf-list">
			<marquee direction="up" scrollamount="1" width="85%" height="40px" onmouseover="this.stop()" onmouseout="this.start()" style="height: 40px; width: 85%;">
			<?php foreach ($qf_list as $w) {?>
				<div class="v1-qf-list-item"><a href="<?php echo base_url()."qf/temple/".$w->templeid?>"><?php echo "[".$w->templename."]".$w->location.$w->userid."：".$w->content?></a></div>
			<?php }?>
			</marquee>
		</div>
		<div class="v1-w25">
			<a href="<?php echo base_url()."temple/id/$temple->id"?>">
			<div class="v1-focus-news-up">
				<div class="v1-focus-news-item v1-focus-news-item-bg1">
					<div class="v1-focus-news-item-title">功德榜</div>
					<div class="v1-focus-news-item-content">
						<?php $num=0;foreach ($roll_list as $roll) {
							echo '['.$roll->templename.']'.$roll->contact.'捐助'.$roll->total.'元<br/>';
							$num++;
							if($num == 3)
								break;
						}
						?>
					</div>
				</div>
			</div>
			</a>
			<?php $num=1;foreach ($news_list as $news) {
				$num++;?>
				<a href="<?php echo base_url()."news/id/$temple->id/".$news->id?>">
				<div class="v1-focus-news<?php if($num == 1) echo "-up";?>">
					<div class="v1-focus-news-item v1-focus-news-item-bg<?php echo $num?>">
						<div class="v1-focus-news-item-title"><?php echo $news->title?></div>
						<div class="v1-focus-news-item-content"><?php echo $news->description?></div>
						<div class="v1-focus-news-item-more">详细信息 >></div>
					</div>
				</div>
				</a>
			<?php 
				if($num == 2)
					break;
			}
			?>
		</div>
		<div class="v1-w50">
			<?php foreach ($news1_list as $news1) {
				echo "<a href=\"".base_url()."news/id/$temple->id/".$news1->id."\">";
				if($news1->thumb == '')
					echo "<div class=\"v1-focus-news-middle\">";
				else
					echo "<div class=\"v1-focus-news-middle\" style=\"height:300px;width:100%;background:url(".base_url().$news1->thumb.") no-repeat;\">";
				echo "<div class=\"v1-focus-news-middle-title\">".substr($news1->description, 0, 24)."</div>";
				echo "<div class=\"v1-focus-news-middle-content\">".substr($news1->title,0,30)."</div>";
				echo "</div>";
				echo "</a>";
			}?>
		</div>
		<div class="v1-w25">
			<?php $num=2;foreach ($activity_list as $activity) {
				$num++;?>
				<a href="<?php echo base_url()."activity/id/$temple->id/".$activity->id?>">
				<div class="v1-focus-news<?php if($num == 3) echo "-up";?>">
					<div class="v1-focus-news-item v1-focus-news-item-bg<?php echo $num?>">
						<div class="v1-focus-news-item-title"><?php echo $activity->title?></div>
						<div class="v1-focus-news-item-content"><?php echo substr($activity->description,0,90)?></div>
						<div class="v1-focus-news-item-more">详细信息 >></div>
					</div>
				</div>
				</a>
			<?php 
				if($num == 4)
					break;
			}
			?>
		</div>
	</div>
</div>
<?php $this->load->view('footer'); ?>