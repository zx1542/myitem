<?php
session_start();
if( !empty($_SESSION['user']) || !empty($_COOKIE['user']) )
{
	$msg = '已登录，无须重复登录';
	$jumpUrl = '../index.php';
	include 'tips.php';
	exit;
};
?>

<?php
header("content-type:text/html;charset=utf8");
$conn = new mysqli('localhost','root','root','myitem');
if($conn->error){
	die('无法注册');
};
$userName=$password="";
$msg = "";
$jumpUrl = "../login.html";
if($_SERVER['REQUEST_METHOD']=="POST"){
	if( empty($_POST["user"]) )
	{

		$msg = "用户名不能为空";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}else{
		$userName=input_fn($_POST["user"]);
		$re = "/^\w+$/";
		
		if( !preg_match($re,$userName) )
		{
			$msg = "用户名格式不正确";
			include "tips.php";
			exit;
		};
		
	}
	if( empty($_POST["password"]) )
	{

		$msg = "密码不能为空";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}else{
		
		$password=input_fn($_POST["password"]);
	
	};
	$sql="SELECT username,password FROM q_user WHERE username='$userName'";
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	if($result->num_rows>0){
		if($row['password']==$password){
			if(empty($_POST["keep"])){
				$_SESSION['user']=$_POST['user'];
			}else{
				setcookie('user',$_POST['user'],time()+5*24*60*60,'/');
			};
			$msg= '登录成功';
			$jumpUrl="../index.php";
			include "tips.php";
			exit;
		}else{
			$msg = "密码不正确";
			include "tips.php";
			exit;//程序终止，后面的代码不执行
		}
	}else{
		$msg = "用户名不存在";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}
	
}else{
	$msg = "不允许非法登录";
	include "tips.php";
	exit;//程序终止，后面的代码不执行
}

function input_fn($data)
{
	$data = htmlspecialchars($data);
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
};

?>