<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('master/v1_master_nav');
?>
<div class="main row">		
	<div class="container">
<?php $this->load->view('sidebar');?>
<div class="row col-md-10">
	<div class="alert alert-info" role="alert">
		<h3>佛教节日</h3>
		<div id="calendar"></div>
	</div>
</div>
</div>
</div>
<?php $this->load->view('footer');?>

<script type="text/javascript">
	$(document).ready(function() {
		var currentLangCode = 'zh-cn';
		function renderCalendar() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				lang: currentLangCode,
				buttonIcons: false, // show the prev/next text
				weekNumbers: true,
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				events: [
					{
						title: 'All Day Event',
						start: '2015-07-28',
						url: 'http://www.baidu.com'
					}
				]
			});
		}
		renderCalendar();
	});
</script>
