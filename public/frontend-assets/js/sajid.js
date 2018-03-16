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


