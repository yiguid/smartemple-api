function check_mobile(str) {
	var re = /^1\d{10}$/;
	if (re.test(str)) {
		return true;
	} else {
		return false;
	}
}

function master_register_submit(url){
	var mobile = $('#mobile').val();
	var contact = $('#contact').val();
	var name = $('#name').val();
	var captcha = $('#captcha').val();
	if(check_mobile(mobile)){
		//检查验证码
		$.post(url + "visit/ajax_temple_verify_mobile", {
			captcha : captcha
		}, function(data) {
			//alert(data);
			if(data == true){
				//发送通知短信
				// $.post(url + "smsservice/send_post", {
				// 	mobile : mobile,
				// 	name : contact,
				// 	content : name+'需要开通智慧供养'
				// }, function(data) {
				// 	//alert("登记成功！");
				// });
				$('#register').submit();
			}
			else
				alert('验证码不正确，请重新输入');
		});
	}
	else{
		alert('请输入正确的手机号码！');
	}
}

function commit_mobile(url){
	var mobile = $('#mobile').val();
	if(check_mobile(mobile)){
    	var $btn = $('#captcha-btn').button('loading');
		$.post(url + "visit/ajax_commit_mobile", {
			mobile : mobile
		}, function(data) {
			//alert(data);
			var json = eval("data="+data);
			//alert(json.code);
			if(json.code == 0){
				alert('验证码已成功发送');
				$btn.text('发送完成');
				$btn.attr('disabled',"disabled");
			}else if(json.code == 1)
			{
				alert('该手机号已注册，请使用账号密码登录');
				$btn.button('reset');
			}
			else{
				alert(jason);
				alert('验证码未成功发送');
				$btn.button('reset');
			}
		});
		
	}
	else
		alert('请输入正确的手机号码');
}

function default_commit_mobile(url){
	var mobile = $('#mobile').val();
	if(check_mobile(mobile)){
    	var $btn = $('#captcha-btn').button('loading');
		$.post(url + "visit/ajax_default_commit_mobile", {
			mobile : mobile
		}, function(data) {
			//alert(data);
			var json = eval("data="+data);
			//alert(json.code);
			if(json.code == 0){
				alert('验证码已成功发送');
				$btn.text('发送完成');
				$btn.attr('disabled',"disabled");
			}else{
				alert(jason);
				alert('验证码未成功发送');
				$btn.button('reset');
			}
		});
		
	}
	else
		alert('请输入正确的手机号码');
}

function verify_mobile(url)
{
	var captcha = $('#captcha').val();
	var mobile = $('#mobile').val();
	if(check_mobile(mobile)){
		$.post(url + "visit/ajax_verify_mobile", {
			captcha : captcha
		}, function(data) {
			//alert(data);
			if(data == true){
				alert('注册成功，默认用户名密码都为手机号，请尽快到个人中心修改密码');
				location.href = url+'login';
			}
			else
				alert('验证码不正确，请重新输入');
		});
	}
	else
		alert('请输入正确的手机号码');
}

function temple_commit_mobile(url){
	var mobile = $('#mobile').val();
	if(check_mobile(mobile)){
    	var $btn = $('#captcha-btn').button('loading');
		$.post(url + "visit/ajax_temple_commit_mobile", {
			mobile : mobile
		}, function(data) {
			//alert(data);
			//alert(json.code);
			if(data == "0" || data == "1"){
				alert('验证码已成功发送');
				$btn.text('发送完成');
				$btn.attr('disabled',"disabled");
			}
			// else if(data == "1")
			// {
			// 	alert('该手机号已经登记过寺院');
			// 	$btn.button('reset');
			// }
			else{
				alert(data);
				alert('验证码未成功发送');
				$btn.button('reset');
			}
		});
		
	}
	else
		alert('请输入正确的手机号码');
}

function resetpwd_commit_mobile(url){
	var mobile = $('#mobile').val();
	if(check_mobile(mobile)){
    	var $btn = $('#captcha-btn').button('loading');
		$.post(url + "visit/ajax_resetpwd_commit_mobile", {
			mobile : mobile
		}, function(data) {
			//alert(data);
			//alert(json.code);
			if(data == "1"){
				alert('验证码已成功发送');
				$btn.text('发送完成');
				$btn.attr('disabled',"disabled");
			}else if(data == "0")
			{
				alert('该手机号尚未注册');
				$btn.button('reset');
			}
			else{
				alert(data);
				alert('验证码未成功发送');
				$btn.button('reset');
			}
		});
		
	}
	else
		alert('请输入正确的手机号码');
}

function resetpwd_verify_mobile(url)
{
	var captcha = $('#captcha').val();
	var mobile = $('#mobile').val();
	if(check_mobile(mobile)){
		$.post(url + "visit/ajax_resetpwd_verify_mobile", {
			captcha : captcha
		}, function(data) {
			//alert(data);
			if(data == true){
				alert('重置密码成功，默认用户名密码都为手机号，请尽快到个人中心修改密码');
				location.href = url+'login';
			}
			else
				alert('验证码不正确，请重新输入');
		});
	}
	else
		alert('请输入正确的手机号码');
}

function verify_mobile_with_donation_order_id(url,donation_order_id)
{
	var captcha = $('#captcha').val();
	var mobile = $('#mobile').val();
	if(check_mobile(mobile)){
		$.post(url + "visit/ajax_verify_mobile", {
			captcha : captcha
		}, function(data) {
			//alert(data);
			if(data == true){
				alert('注册成功，默认用户名密码都为手机号，请尽快到个人中心修改密码');
				location.href = url+'checkout/update/'+ donation_order_id;
			}
			else
				alert('验证码不正确，请重新输入');
		});
	}
	else
		alert('请输入正确的手机号码');
}
