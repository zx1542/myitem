<?php
session_start();//开启session
$conn = new mysqli('localhost','root','root','myitem');
if($conn->error){
	die('无法注册');
};

$msg = '';
$jumpUrl = 'admin.php';
if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	
	if( empty( $_POST['username'] ) )
	{
		$msg = '用户名不能为空';
		include 'tips.php';
		exit;
	};
	
	if( empty( $_POST['password'] ) )
	{
		$msg = '密码不能为空';
		include 'tips.php';
		exit;
	};
	$username=$_POST['username'];
	$sql="SELECT * FROM h_user WHERE username='$username'";
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	if($result->num_rows>0){
		if($row['password']==$_POST['password']){
			$_SESSION['username'] = $_POST['username'];
			$msg = '登录成功';
			$jumpUrl = 'column.php';
			include 'tips.php';
			exit;
		}else{
			$msg = "密码不正确";
			include "tips.php";
			exit;//程序终止，后面的代码不执行
		};
	}else{
		$msg = "管理员不存在";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	};
}
else
{
	$msg = '非法登录';
	include 'tips.php';
	exit;
};


?>