/*
* Author : Muhammad sajid
* Created Date : 10/2/2018
*/
$('#head').on('click',function(){
	$('#dispatch').prop('checked', false); // Unchecks it
})
$('#dispatch').on('click',function(){
	$('#head').prop('checked', false); // Unchecks it
})

function deactive(id){
	var postURL = url()+'/deactiveUser';
	var usertoken = getToken();
	$.ajax({
		url:postURL,
		data:{id:id,_token:usertoken},
		type:"POST",
		success:function(res){
			if(res ==1){
				window.location.href ='login';
			}
			else{
				alert(res);
			}
		}

	});
	
}
