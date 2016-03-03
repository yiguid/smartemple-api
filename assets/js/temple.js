$(document).ready(function(){
	// $(".xj1").click(function(){
	// 	$(".xji1").slideToggle();
	// });
	// $(".xj2").click(function(){
	// 	$(".xji2").slideToggle();
	// });
	// $(".xj3").click(function(){
	// 	$(".xji3").slideToggle();
	// });
	// $(".xj4").click(function(){
	// 	$(".xji4").slideToggle();
	// });

	//鼠标经过莲花的效果
	$("#ci1 img").mouseenter(function(){
		$("#ci1").fadeToggle(1000);
		$("#ci1").fadeToggle(1000);
	});

	// $(".center-img").mouseleave(function(){
	// 	$("#ci1").fadeIn(1000);
	// 	//$("#ci2").fadeOut(1000);
	// });

	// $(".logo").mouseenter(function(){
	// 	$(".banner").animate({
	// 		height:'80px'
	// 	});
	// 	$(".logo").animate({
	// 		width:'170px',
	// 		fontSize:'30px',
	// 		lineHeight:'80px'
	// 	});

	// 	$(".logo img").animate({
	// 		width:'40px'
	// 	});

	// });
	// $(".logo").mouseleave(function(){
	// 	$(".banner").animate({
	// 		height:'56px'
	// 	});
	// 	$(".logo").animate({
	// 		width:'160px',
	// 		fontSize:'26px',
	// 		lineHeight:'56px'
	// 	});

	// 	$(".logo img").animate({
	// 		width:'32px'
	// 	});
	// });

});

//添加到购物车的js
function item_add(templeid, donationid,url){
	var info = $('#item-add');
	//添加到购物车
	$.post(url + "temple/ajax_cart_add", {
		donationid : donationid
	}, function(data) {
		var json = eval("data="+data);
		$('.global-checkout-info').html(json.total_items+"件 ￥"+json.total);
	});
	info.html('<a href=\"'+url+'temple/id/'+ templeid +'\" class=\"btn btn-success\">供养成功，跳转支付中...</a>');
	window.setTimeout("cart_to_checkout('"+url+"')",1500);
}

//添加到购物车的js
function cart_add(donationid,url){
	var info = $('#sold-info'+donationid);
	info.slideToggle();
	//添加到购物车
	$.post(url + "temple/ajax_cart_add", {
		donationid : donationid
	}, function(data) {
		var json = eval("data="+data);
		$('.global-checkout-info').html(json.total_items+"件 ￥"+json.total);
	});
	info.delay(1000).slideToggle();
	window.setTimeout("cart_to_checkout('"+url+"')",1500);
}

function cart_to_checkout(url){
	location.href = url + 'checkout';
}

function cart_sub(donationid,url){
	//更新购物车
	$.post(url + "temple/ajax_cart_sub", {
		donationid : donationid
	}, function(data) {
		var json = eval("data="+data);
		$('.global-checkout-info').html(json.total_items+"件 ￥"+json.total);
	});
}

function cart_remove(donationid,url){
	$.post(url + "temple/ajax_cart_remove", {
		donationid : donationid
	}, function(data) {
		var json = eval("data="+data);
		$('.order-info').html(json.total_items+"件 ￥"+json.total);
	});
}

function order_remove(donationid,url)
{
	$.post(url + "temple/ajax_cart_remove", {
		donationid : donationid
	}, function(data) {
		$('#tr'+donationid).fadeOut(800, function() {
			var json = eval("data="+data);
        	$('.order-info').html("供养"+json.total_items+"个物品，总计"+json.total+"元");
    	});
	});
	
}

function order_plus(donationid,url){
	var item = $('#soldcount'+donationid);
	var num = parseInt(item.val());
	item.val(num + 1);
	//添加到购物车
	$.post(url + "temple/ajax_cart_add", {
		donationid : donationid
	}, function(data) {
		var json = eval("data="+data);
		$('.order-info').html("供养"+json.total_items+"个物品，总计"+json.total+"元");
		//更新小计
		var price = $('#tr' + donationid).find('td:eq(1)').html().replace("￥","");
		//alert(price);
		var qty = $('#soldcount' + donationid).val();
		//alert(qty);
		var new_subtotal = price * qty;
		$('#tr' + donationid).find('td:eq(3)').html("￥" + new_subtotal);
	});
}

function order_minus(donationid,url){
	var item = $('#soldcount'+donationid);
	var num = parseInt(item.val());
	if(num > 1){
		item.val(num - 1);
		//更新购物车
		$.post(url + "temple/ajax_cart_sub", {
			donationid : donationid
		}, function(data) {
			var json = eval("data="+data);
			$('.order-info').html("供养"+json.total_items+"个物品，总计"+json.total+"元");
			//更新小计
			var price = $('#tr' + donationid).find('td:eq(1)').html().replace("￥","");
			//alert(price);
			var qty = $('#soldcount' + donationid).val();
			//alert(qty);
			var new_subtotal = price * qty;
			$('#tr' + donationid).find('td:eq(3)').html("￥" + new_subtotal);
		});
	}
}

//刷新页面的add
function order_add(donationid,url){
	var info = $('#sold-info'+donationid);
	info.slideToggle();	
	//添加到购物车
	$.post(url + "temple/ajax_cart_add", {
		donationid : donationid
	}, function(data) {
		var json = eval("data="+data);
		$('.order-info').html("供养"+json.total_items+"个物品，总计"+json.total+"元");
	});
	info.delay(500).slideToggle();
}

//物品数量加减的js
function cart_minus(id,url)
{
	var item = $('#soldcount'+id);
	var num = parseInt(item.val());
	if(num > 0){
		item.val(num - 1);
		cart_sub(id,url);
	}
}

function cart_plus(id,url)
{
	var item = $('#soldcount'+id);
	var num = parseInt(item.val());
	item.val(num + 1);
	//alert(num);
	//添加到购物车
	$.post(url + "temple/ajax_cart_add", {
		donationid : id
	}, function(data) {
		var json = eval("data="+data);
		$('.global-checkout-info').html(json.total_items+"件 ￥"+json.total);
	});
}

function construction()
{
	alert('支付方式备案中，请先选择支付宝支付');
}

function qrcode(){
	$('#qrcode-img').slideToggle();
}

function donation_contact_list(){
	$('#donation-contact-list').slideToggle();
}
