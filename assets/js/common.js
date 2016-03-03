$(function () {
  $('[data-toggle="popover"]').popover()
})

function del_confirm()
{
	if(!confirm("确认删除操作？"))
		window.event.returnValue = false;
}

function quit_confirm()
{
	if(!confirm("确认取消报名？"))
		window.event.returnValue = false;
}

function check_form()
{
	var all_checked = true;
	var loc;
	//对于每一个问题，如果单选和多选都找不到已选择的值
	$("div.v1-question-option").each(function(){
	    if($(this).find('input:radio:checked').val() == null
	     && $(this).find('input:checkbox:checked').val() == null){
	    	all_checked = false;
	    	loc = $(this).offset().top - 60;
	    	$(this).css("border","1px solid #E40000");
	    }
	    else{
	    	$(this).css("border","none");
	    }
	    //alert($(this).find('input:radio:checked').val());
	});
	if(!all_checked){
		$("html,body").animate({scrollTop:loc},300);
		window.event.returnValue = false;
	}
}

function show_alert(title,content)
{
	var box = $('#alert-modal');
	box.find('.modal-title').html(title);
	box.find('.modal-body p').html(content);
	box.modal();
}

function check_login(url,userid,userdetail){
	if(userid == 0)
		$('#login-form').modal();
	else if(userdetail == false)
		show_alert('个人信息未填全','请前往个人中心填写 <a class="btn btn-primary" href=' + url + 'user/home>前往个人中心</a>');
	else
		$('#regist-form').modal();
}

function zhongchou_login(url,userid,rewardid){
	if(userid == 0){
		$('#login-form').modal();
		window.event.returnValue = false;
	}else
		show_alert('请选择支付方式','<a class="btn btn-success" href=' + url + 'user/wxpay/pay/'+rewardid+'>微信支付</a> <a class="btn btn-info" href=' + url + 'user/zhongchou/alipay/'+rewardid+'>支付宝支付</a>');
}

function cashpay_confirm()
{
	if(!confirm("确认完成现场支付操作？"))
		window.event.returnValue = false;
}

function add_donation(donationid,baseurl)
{
	var soldcount = $('#soldcount'+donationid).val();
	var amount = $('#amount'+donationid).html();
	if(isNaN(soldcount) || parseInt(soldcount) <= 0){
		alert("请输入正确的数量");
		return false;
	}

	if(parseInt(soldcount) > parseInt(amount)){
		alert("选择的数量超过了总数，请重新选择");
		return false;
	}
	$.post(baseurl + "master/ajax/add_donation", {
		donationid : donationid,
		soldcount : soldcount
	}, function(data) {
		//alert(data);
		$('#choose'+data).html("<span class=\"glyphicon glyphicon-ok-sign glyphicon-big-sign\"></span> <a href=\"javascript:remove_donation(" + donationid + ",'" + baseurl + "')\"><span class=\"glyphicon glyphicon-remove-sign glyphicon-big-sign\"></span></a>");
		$('#soldcount'+donationid).attr("readonly",true);
	});
}

function remove_donation(donationid,baseurl)
{
	$.post(baseurl + "master/ajax/remove_donation", {
		donationid : donationid
	}, function(data) {
		//alert(data);
		$('#choose'+data).html("<a href=\"javascript:add_donation(" + donationid + ",'" + baseurl + "')\"><span class=\"glyphicon glyphicon-ok-sign glyphicon-big-sign\"></span></a>");
		$('#soldcount'+donationid).attr("readonly",false);
	});
}


//物品数量加减的js
function count_minus(id)
{
	var item = $('#soldcount'+id);
	var num = parseInt(item.val());
	if(num > 0)
		item.val(num - 1);
}

function count_plus(id)
{
	var item = $('#soldcount'+id);
	var amount_item = $('#amount'+id);
	var num = parseInt(item.val());
	var amount = parseInt(amount_item.html());
	if(num < amount)
		item.val(num + 1);
}

function start_print()
{
	window.print();
}

function ilike(url,type,id){
	if($('#ilike').attr('class') == 'glyphicon glyphicon-heart-empty'){
		$.post(url + "user/" + type + "/ilike", {
			id : id
		}, function(data) {
			var count = $('#ilike-count').html();
			$('#ilike-count').html(parseInt(count)+1);
			$('#ilike').removeClass("glyphicon-heart-empty").addClass("glyphicon-heart");
		});
	}
}


function more(url,type){
	var more = $('#more');
	//more.remove();
	more.html('加载中...');
	$.post(url + "user/" + type + "/more", {
	}, function(data) {
		//alert(data);
		more.remove();
		var list_group = $('.v1-list-group');
		list_group.append(data);
	});

	//loading is a global var
	loading = false;
}
