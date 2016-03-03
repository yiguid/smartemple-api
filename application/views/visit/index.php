<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
?>
<div class="slider-map row">
	<div class="container">
		<div class="map-info text-center">
            <div id="china-map"></div>
            <div id="map-location">当前省份：<span id="click-call-back">浙江（点击地图切换省份）</span>
            </div>
            <div id="temple-map">
            	<?php foreach ($temple as $t) {
            		echo "<a class=\"btn btn-buddha-lt btn-visit-temple\" href=\"".
					base_url()."temple/id/".$t->id."\">".$t->name."</a> ";
            	}?>
            </div>
            <div id="map-register">地图中没有你想找的寺院：
            	<a class="btn btn-grey" href="<?php echo base_url('register');?>">点击登记</a>
            	<?php //var_dump($ip_infos);?>
            </div>
		</div>
	</div>
</div>
<div class="row">
	<div class="container" id="temple-wish">
		<marquee direction="up" scrollamount="1" width="100%" height="80px"
		 onmouseover="this.stop()" onmouseout="this.start()" 
		 style="height: 80px; width: 100%;">
		<?php foreach ($wish as $w) {?>
		<div class="temple-wish-item">
			<a href="<?php echo base_url()."qf/temple/".$w->templeid?>">
				<?php echo $w->location.$w->userid."：".$w->content?>
			</a>
		</div>
		<?php }?>
		</marquee>
	</div>
</div>
<?php $this->load->view('footer');?>
<script language="javascript" src="<?php echo base_url();?>assets/js/raphael-min.js" type="text/javascript"></script>
<script language="javascript" src="<?php echo base_url();?>assets/js/map.js" type="text/javascript"></script>
<script language="javascript" src="<?php echo base_url();?>assets/js/chinaMapConfig.js" type="text/javascript"></script>
<script type="text/javascript">
function render_map(size,temple){
	var tip = false;
	if(size >= 500)
		tip = true;
	//alert(temple);
	$('#china-map').SVGMap({
		mapName: 'china',
		mapWidth: size,
		mapHeight: size,
		showTip: tip,
		//必须要转换成json格式
		stateData: eval("data="+temple),
        clickCallback: function(stateData, obj){
           $('#click-call-back').html(obj.name);
           //ajax获取数据
           $.post(window.location.href + "/ajax_get_temple", {
			province : obj.name
			}, function(data) {
				//alert(data);
				$('#temple-map').html(data);
			});
       },

	});
	// {
 //        'heilongjiang': {'stateInitColor': 1},
 //        'beijing': {'stateInitColor': 2},
 //        'shanghai': {'stateInitColor': 3},
 //        'tianjin': {'stateInitColor': 4},
 //        'sichuan': {'stateInitColor': 5},
 //        'shandong': {'stateInitColor': 6},
 //        'shanxi': {'stateInitColor': 3},
 //        'zhejiang': {'stateInitColor': 4},
 //        'jiangshu': {'stateInitColor': 2},
 //        'hunan': {'stateInitColor': 4},
 //        'guizou': {'stateInitColor': 5},
 //        'neimongol': {'stateInitColor': 6},
 //        'henan': {'stateInitColor': 3},
 //        'gansu': {'stateInitColor': 4},
 //        'ningxia': {'stateInitColor': 2},
 //        'jilin': {'stateInitColor': 2}
	// }
}
window.onresize = function(){
	var size = 500;
	if($(window).width() < 500)
		size = 300;
	else
		size = 500;
	$.post(window.location.href + "/ajax_get_temple_map", {
	}, function(data) {
		//alert(data);
		render_map(size,data);
	});
}

$(function(){
	var size = 500;
	if($(window).width() < 500)
		size = 300;
	else
		size = 500;
	$.post(window.location.href + "/ajax_get_temple_map", {
	}, function(data) {
		//alert(data);
		render_map(size,data);
	});
	
});
</script>
<!-- 
	请选择你所在的寺院：<br/>
	<?php echo $location;?>
			<?php foreach($temple as $t):?>  
				<a class="btn btn-success" href="<?php echo base_url()."visit/temple/".$t->englishname; ?>"><?php echo $t->name; ?></a><br/>
			<?php endforeach;?>  
-->