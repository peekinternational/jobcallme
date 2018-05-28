/*
* Author : Muhammad sajid
* Created Date : 10/2/2018
*/
/* to get url use jsUrl function*/
/* to get csrftoken use jsCsrfToken function */


$('#head').on('click',function(){
	$('#dispatch').prop('checked', false); // Unchecks it
})
$('#dispatch').on('click',function(){
	$('#head').prop('checked', false); // Unchecks it
})
$('#anynational').on('click',function(){
	$('#onlynational').prop('checked', false); // Unchecks it
})
$('#onlynational').on('click',function(){
	$('#anynational').prop('checked', false); // Unchecks it
})

/* likes functionality js code*/


