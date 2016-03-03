function add_reply(parentid,url)
{
	//alert(parentid);
	var reply = $('#reply'+ parentid);
	if(reply.html()=="")
		reply.html("<form action='" + url + "qf/reply' method=\"post\" class=\"form-horizontal\"><div class=\"form-group col-md-12\"><div class=\"col-sm-12\"><label for=\"userid\">内容：</label></div><div class=\"col-sm-12\"><textarea class=\"form-control\" rows=\"3\" name=\"content\" id=\"content\"></textarea></div><div class=\"col-sm-10\"><input type=\"hidden\" value=\"" + parentid + "\" name=\"parentid\"></input><button type=\"submit\" class=\"btn btn-primary\">发送</button></div></div></form>");
	else
		reply.html('');
}