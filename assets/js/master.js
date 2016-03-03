function add_activity_category(url){
	var name = $('#new_activity_category');
	if(name != ""){
		$.post(url + "master/activity/ajax_add_category", {
			name : name.val()
		}, function(data) {
			if(data != true){
				//alert('添加成功');
				$('#catoptable').append(data);
				name.val('');
			}
			else
				alert('添加不成功');
		});
	}
	else
		alert('请输入正确的类型');
}

function edit_activity_category(url,id){
	var name = $('#catop'+id) ;
	if(name != ""){
		$.post(url + "master/activity/ajax_edit_category", {
			id : id,
			name : name.val()
		}, function(data) {
			//alert(data);
			if(data == true){
				alert('修改成功');
			}
			else
				alert('修改不成功');
		});
	}
	else
		alert('请输入正确的类型');
}

function delete_activity_category(url,id){
	if(confirm("确认删除操作？")){
		$.post(url + "master/activity/ajax_delete_category", {
			id : id
		}, function(data) {
			if(data == true){
				//alert('删除成功');
				$('#catoptr'+id).remove();
			}
			else
				alert('删除不成功');
		});
	}
}