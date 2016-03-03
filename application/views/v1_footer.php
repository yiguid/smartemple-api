	<div class="row v1-footer">
		<div class="container">
			Copyright © 2014-2016. 智慧寺院. 京ICP备14018534号-3
			<?php if(base_url() != 'http://localhost/temple/'){?>
			<span style="display:none;">
			<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1253962708'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/stat.php%3Fid%3D1253962708%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
			</span>
			<?php }?>
		</div>
	</div>
</body>
<script language="javascript" src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script language="javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script language="javascript" src="<?php echo base_url();?>assets/js/visit.js" type="text/javascript"></script>
    <script language="javascript" src="<?php echo base_url();?>assets/js/temple.js" type="text/javascript"></script>
    <script language="javascript" src="<?php echo base_url();?>assets/js/common.js" type="text/javascript"></script>
    <?php if($this->session->userdata('usertype') == 'master') {?>
	<script language="javascript" src="<?php echo base_url();?>assets/js/master.js" type="text/javascript"></script>
	<script language="javascript" src="<?php echo base_url();?>assets/js/qf.js" type="text/javascript"></script>
    <?php }?>
    <script language="javascript" src="<?php echo base_url();?>assets/js/moment.min.js" type="text/javascript"></script>
    <script language="javascript" src="<?php echo base_url();?>assets/js/fullcalendar.min.js" type="text/javascript"></script>
	<script language="javascript" src="<?php echo base_url();?>assets/js/lang/zh-cn.js" type="text/javascript"></script>
	<script language="javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script language="javascript" src="<?php echo base_url();?>assets/js/locales/bootstrap-datetimepicker.zh-CN.js" type="text/javascript"></script>
</html>