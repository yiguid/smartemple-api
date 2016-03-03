<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('temple/temple_nav');
?>
<div class="row">
	<div class="container">
	<div class="bs-example">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
<!--       <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
        <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
      </ol> -->
      <div class="carousel-inner" role="listbox">
        <div class="item">
          <img src="<?php echo base_url();?>assets/images/qf1.png" width="1200">
        </div>
        <div class="item active">
          <img src="<?php echo base_url();?>assets/images/qf2.png" width="1200">
        </div>
        <div class="item">
          <img src="<?php echo base_url();?>assets/images/qf3.png" width="1200">
        </div>
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
	</div>
	</div>
</div>
<div id="main" class="container">
	<h4 style="color:#938561; padding-left:14px;">
	<?php if(isset($temple))
		echo $temple->name;?> - 祈福墙 
		<?php if($this->session->userdata('usertype') == 'admin'){?>
			<a href="<?php echo base_url();?>admin/qf" class="btn btn-primary btn-xs" role="link">返回祈福平台</a>
		<?php }else if($this->session->userdata('usertype') == 'master'){?>
			<a href="<?php echo base_url();?>master/qf" class="btn btn-primary btn-xs" role="link">返回祈福管理</a>
		<?php }else{?>
			<a href="<?php echo base_url('temple/id/'.$this->session->userdata('templeid'));?>" class="btn btn-primary btn-xs" role="link">前往寺院主页</a>
		<?php }?>
	</h4>
<div class="row">
	<div class="col-sm-10">
		<a href="javascript:make_a_wish(1)" class="btn btn-danger" role="button">点击祈福</a>
	</div>
</div>
<div id="ctrl-top" class="row" style="display:none;">
	<?php echo form_open('qf/add','class="form-horizontal" ');?>
	<div class="form-group col-md-12">
		<div class="col-sm-12"><label for="userid">昵称：</label></div>
		<div class="col-sm-12">
			<input type="text" class="form-control" name="userid" id="userid" 
			<?php if($this->session->userdata('realname') != null) echo 'value="'.$this->session->userdata('realname').'"';?>/>
		</div>
	<div class="form-group col-md-12">
	</div>
		<div class="col-sm-12"><label for="userid">内容：</label></div>
		<div class="col-sm-12"><textarea class="form-control" rows="3" name="content" id="content"></textarea></div>
	<div class="form-group col-md-12">
	</div>
		<div class="col-sm-10"><button type="submit" class="btn btn-primary">发送</button></div>
	</div>
	<?php echo form_close();?>
</div>

<div class="row">
  <div id="board" class="col-md-12">
  	<?php $type = array('primary');?>
    <?php foreach($wish as $w):?> 
    <?php $color = $type[array_rand($type)];?>
	<div class="label label-<?php echo $color;?> board-username"><?php echo substr($w->userid, 0,15)?></div>
	<div class="alert alert-<?php echo $color;?>">
		<?php 
		echo "[ 来自".$w->location." ".$w->datetime." ]<br/>".$w->content;
		if($this->session->userdata('usertype') == 'master' && $this->session->userdata('templeid') == $temple->id)
			echo "<span style=\"float:right;\" class=\"btn btn-xs btn-primary\"><a style=\"color:white;\" href=\"javascript:add_reply('$w->id','".base_url()."')\">回复</a></span>";
		?>
		<?php foreach($reply as $r):
			if($r->parentid == $w->id)
				echo "<div><div class=\"master-reply label-danger\">"
					.$r->userid."：".$r->content." [".$r->datetime." ]"."</div></div>";
		?> 

		<?php endforeach;?>
		<div id="reply<?php echo $w->id?>"></div>
	</div>  
	<?php endforeach;?>  
  </div>
</div>
<div class="row">
	<div class="col-sm-10">
		<a href="javascript:make_a_wish(2)" class="btn btn-danger" role="button">点击祈福</a>
	</div>
</div>
<div id="ctrl-bottom" class="row" style="display:none;">
	<?php echo form_open('qf/add','class="form-horizontal" ');?>
	<div class="form-group col-md-12">
		<div class="col-sm-12"><label for="userid">昵称：</label></div>
		<div class="col-sm-12"><input type="text" class="form-control" name="userid" id="userid"
		<?php if($this->session->userdata('realname') != null) echo 'value="'.$this->session->userdata('realname').'"';?> /></div>
	<div class="form-group col-md-12">
	</div>
		<div class="col-sm-12"><label for="userid">内容：</label></div>
		<div class="col-sm-12"><textarea class="form-control" rows="3" name="content" id="content"></textarea></div>
	<div class="form-group col-md-12">
	</div>
		<div class="col-sm-10"><button type="submit" class="btn btn-primary">发送</button></div>
	</div>
	<?php echo form_close();?>
</div>
</div>
<script type="text/javascript">
function make_a_wish(num){
	if(num == 1)
		var ctr = $('#ctrl-top');
	else
		var ctr = $('#ctrl-bottom');
	if(ctr.css("display") == 'none')
		ctr.slideDown('slow');
	else
		ctr.slideUp('slow')
}
</script>
<?php $this->load->view('footer');?> 