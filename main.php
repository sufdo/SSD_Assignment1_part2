<?php
require_once 'checkToken.php';
$val = $_POST["token"];
if(isset($_POST['retrievePost'])){
	if(token::checkToken($val,$_COOKIE['csrfCookie'])){
		echo "Token Updated".$_POST['retrievePost'];		
	}
	else{
	echo "wrong".$_COOKIE['csrfCookie'];
	}
}
?>