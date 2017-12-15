<?php
session_start();
if(empty($_SESSION['user'])){
	setcookie('user',1,time()-1,'/');
}else{
	
	unset($_SESSION['user']);
}
$msg = '成功退出';
$jumpUrl = '../login.html';
include 'tips.php';
exit;
?>