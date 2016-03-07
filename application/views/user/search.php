<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('v1_header');
$this->load->view('v1_user_nav');
?>

<div class="main row">
<div class="container">
	<div class="v1-list-group">
	<?php foreach ($news_list as $news) {?>
		<a href="<?php echo base_url()."user/news/id/$news->id";?>" class="v1-list-group-item">
			<div class="v1-list-news-item">
			<div class="v1-list-news-templename"><?php echo "[".($news->templename!=''?$news->templename:'智慧寺院网')."]";?></div>
			<div class="v1-list-news-title"><?php echo $news->title;?></div>
			<div class="v1-list-news-date"><?php echo date('Y-m-d', strtotime($news->inputtime));?></div>
			</div>
		</a>
	<?php }
	?>
	</div>

	<?php foreach ($temple_list as $temple) {?>
	<a href="<?php echo base_url().'temple/route/'.$temple->id?>">
	<div class="v1-w100 v1-donation-item-list">
		<div class="v1-donation-item-img">
			<img src="<?php 
			if($temple->planimg != '')
				echo base_url().$temple->planimg;
			else
				echo base_url().'assets/images/xj'.rand(1,3).'.jpg';
			?>" class="img-responsive" ></div>
		<div class="v1-donation-item-title">捐助<?php echo $temple->name?>建设</div>
		<div class="v1-donation-item-content"><?php echo $temple->name."位于".$temple->province.$temple->city."，现任主持是".$temple->master;?></div>
		<div class="v1-donation-item-statistics">点击进入寺院主页</div>
	</div>
	</a>
	<?php }?>
	
	<?php $num=1;foreach ($master_list as $master) {?>
		<a href="<?php echo base_url()."user/master/id/".$master->id;?>">
		<div class="v1-fl v1-w10 v1-rec-master">
			<div class="v1-rec-master-img">
				<img src="<?php echo base_url().($master->avatar == ''?"assets/images/fashi-small.jpg":$master->avatar)?>" />
			</div>
			<div class="v1-rec-master-name">
				<?php echo $master->realname?><br/>
				<span class="glyphicon glyphicon-heart"></span> <?php echo $master->views?>
			</div>	
		</div>
		</a>
	<?php $num++;}?>
	<div style="clear:both;"></div>
	<p>
	<?php
		if(count($news_list) == 0 && count($temple_list) == 0 && count($master_list) == 0)
			echo "<h4>没有搜索到相关内容</h4>"; 
		else
			echo '新闻搜索相关结果：'.count($news_list).'条 <br/> 寺院搜索相关结果：'.count($temple_list).'条 <br/> 法师搜索相关结果：'.count($master_list).'条';
	?>
	</p>
</div>
</div>
	

<?php $this->load->view('v1_footer');?>