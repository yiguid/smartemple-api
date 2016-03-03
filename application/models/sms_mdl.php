<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sms_mdl extends CI_Model {

	public function __construct()
	{
		parent:: __construct();
		//APPPATH.
		include_once(APPPATH."third_party/sendsms/CCPRestSmsSDK.php");
	}

	/**
	  * 发送模板短信
	  * @param to 手机号码集合,用英文逗号分开
	  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
	  * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
	  */       
	function sendTemplateSMS($to,$datas,$tempId)
	{
	     // 初始化REST SDK
	     //主帐号,对应开官网发者主账号下的 ACCOUNT SID
		$accountSid= 'aaf98f894bc4f9b9014bd7edd73b0814';
		//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
		$accountToken= '2050637135a64634832943abb28f389c';
		//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
		//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
		$appId='aaf98f894bc4f9b9014bd7ee3d6f0817';
		//请求地址
		//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
		//生产环境（用户应用上线使用）：app.cloopen.com
		$serverIP='sandboxapp.cloopen.com';
		//请求端口，生产环境和沙盒环境一致
		$serverPort='8883';
		//REST版本号，在官网文档REST介绍中获得。
		$softVersion='2013-12-26';
	    $rest = new REST($serverIP,$serverPort,$softVersion);
	    $rest->setAccount($accountSid,$accountToken);
	    $rest->setAppId($appId);
	    
	    // 发送模板短信
	    //echo "Sending TemplateSMS to $to <br/>";
	    $result = $rest->sendTemplateSMS($to,$datas,$tempId);
	    if($result == NULL ) {
	        //echo "result error!";
	        return "result error!";
	    }
	    if($result->statusCode!=0) {
	        //echo "error code :" . $result->statusCode . "<br>";
	        //echo "error msg :" . $result->statusMsg . "<br>";
	        //TODO 添加错误处理逻辑
	        return $result->statusCode." | ".$result->statusMsg;
	    }else{
	        //echo "Sendind TemplateSMS success!<br/>";
	        // 获取返回信息
	        $smsmessage = $result->TemplateSMS;
	        //echo "dateCreated:".$smsmessage->dateCreated."<br/>";
	        //echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
	        //TODO 添加成功处理逻辑
	        return true;
	    }
	}

	/**
	* url 为服务的url地址
	* query 为请求串
	*/
	function sock_post($url,$query){
		$data = "";
		$info=parse_url($url);
		$fp=fsockopen($info["host"],80,$errno,$errstr,30);
		if(!$fp){
			return $data;
		}
		$head="POST ".$info['path']." HTTP/1.0\r\n";
		$head.="Host: ".$info['host']."\r\n";
		$head.="Referer: http://".$info['host'].$info['path']."\r\n";
		$head.="Content-type: application/x-www-form-urlencoded\r\n";
		$head.="Content-Length: ".strlen(trim($query))."\r\n";
		$head.="\r\n";
		$head.=trim($query);
		$write=fputs($fp,$head);
		$header = "";
		while ($str = trim(fgets($fp,4096))) {
			$header.=$str;
		}
		while (!feof($fp)) {
			$data .= fgets($fp,4096);
		}
		return $data;
	}

	/**
	* 模板接口发短信
	* apikey 为云片分配的apikey
	* tpl_id 为模板id
	* tpl_value 为模板值
	* mobile 为接受短信的手机号
	*/
	function tpl_send_sms($apikey, $tpl_id, $tpl_value, $mobile){
		$url="http://yunpian.com/v1/sms/tpl_send.json";
		$encoded_tpl_value = urlencode("$tpl_value");
		$post_string="apikey=$apikey&tpl_id=$tpl_id&tpl_value=$encoded_tpl_value&mobile=$mobile";
		return sock_post($url, $post_string);
	}

	/**
	* 普通接口发短信
	* apikey 为云片分配的apikey
	* text 为短信内容
	* mobile 为接受短信的手机号
	*/
	//此为本系统现在使用的send接口
	function send_sms($apikey, $text, $mobile){
		$url="http://yunpian.com/v1/sms/send.json";
		$encoded_text = urlencode("$text");
		$post_string="apikey=$apikey&text=$encoded_text&mobile=$mobile";
		return $this->sock_post($url, $post_string);
	}

}
?>