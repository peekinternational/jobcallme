<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$hello = $_POST['email'];
echo $hello;


?>