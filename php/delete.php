<?php

$conn=new mysqli('localhost','root','root','myitem');
if($conn->error){
	die('数据库连接失败');
};
$id=$_GET['id'];
$sql="DELETE FROM h_content WHERE id=$id";
if($conn->query($sql)){
	$msg='删除成功';
	$jumpUrl='column.php';
	include 'tips.php';
	exit;
};

?>
