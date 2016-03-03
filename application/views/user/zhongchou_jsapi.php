<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付</title>
    <script type="text/javascript">

    function writeObj(obj){ 
	    var description = ""; 
	    for(var i in obj){   
	        var property=obj[i];   
	        description+=i+" = "+property+"\n";  
	    }   
	    alert(description); 
	} 

	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//writeObj(res);
				//alert(res.err_code+res.err_desc+res.err_msg);
				//跳转到订单页面'user/order/'.$donation_order_id
				if(res.err_msg == "get_brand_wcpay_request:ok"){
					//alert(res.err_code+res.err_desc+res.err_msg);
					//alert('支付成功');
					<?php $this->session->set_userdata('wxpay',true);?>
					window.location.href = 'success';
				}else{
					//返回跳转到订单详情页面
					//alert('支付失败');
					window.location.href = 'fail'; 
				}
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	//获取共享地址
	function editAddress()
	{
		WeixinJSBridge.invoke(
			'editAddress',
			<?php echo $editAddress; ?>,
			function(res){
				var value1 = res.proviceFirstStageName;
				var value2 = res.addressCitySecondStageName;
				var value3 = res.addressCountiesThirdStageName;
				var value4 = res.addressDetailInfo;
				var tel = res.telNumber;
				
				//alert(value1 + value2 + value3 + value4 + ":" + tel);
			}
		);
	}
	
	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', editAddress); 
		        document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
			editAddress();
		}
	};
	window.setTimeout('callpay()',2000); 
	</script>
</head>
<body>
    <br/>
    <font color="#5cb85c"><b>该笔订单支付金额为<span style="color:#4cae4c;font-size:20px"><?php echo $total;?>元</span>钱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 10px;background-color:#5cb85c; border:0px #4cae4c solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >跳转到微信支付...</button>
	</div>
</body>
</html>