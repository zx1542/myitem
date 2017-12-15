<?php
header("Content-type:text/html;charset=utf8");	
$conn = new mysqli('localhost','root','root','myitem');
if($conn->error){
	die('数据库连接失败');
};

$userName = $password = $password1 = $email = $tel = $province = $sex = $hobbyStr = $reader = "";
$msg = "";
$jumpUrl = "../register.html";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	
	
	if( empty($_POST["user"]) )
	{
		//$userNameErr = "用户名不能为空";
		$msg = "用户名不能为空";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}
	else
	{
		$userName = input_fn($_POST["user"]);
		
		$re = "/^\w+$/";
		
		if( !preg_match($re,$userName ) )
		{
			//$userNameErr = "用户名格式不正确";
			$msg = "用户名格式不正确";
			include "tips.php";
			exit;
		};
		
	};
	if( $_POST["password"]!=$_POST["password1"] )
	{
		$msg = "密码不一致";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}
	else
	{
		$password = input_fn($_POST["password"]);
		$password1 = input_fn($_POST["password1"]);
	};
	
	if( empty($_POST["email"]) )
	{
		$msg = "邮箱不能为空";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}
	else
	{
		$email = input_fn($_POST["email"]);
		
		$re = "/^\w+@\w+\.\w+$/";
		
		if( !preg_match($re,$email ) )
		{
			$msg = "邮箱名格式不正确";
			include "tips.php";
			exit;
		};
	};
	
	if( empty($_POST["tel"]) )
	{
		$msg = "手机号不能为空";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}
	else
	{
		$tel = input_fn($_POST["tel"]);
		
		$re = "/^1[3578]\d{9}$/";
		
		if( !preg_match($re,$tel ) )
		{
			$msg = "手机号格式不正确";
			include "tips.php";
			exit;
		};
	};
	
	
	if($_POST["province"]=="请选择省份" )
	{
		$msg = "请选择省份";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}
	else
	{
		$province = input_fn($_POST["province"]);
	};
	
	if( empty($_POST["sex"]) )
	{
		$msg = "性别不能为空";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}
	else
	{
		$sex = input_fn($_POST["sex"]);
	};
	
	if(empty($_POST["hobby"]))
	{
		$msg = "选个爱好吧";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}
	else
	{
		$hobby = $_POST["hobby"];//得到的是一个数组，我们需要把它转成一个字符串
		
		for($i=0;$i<count($hobby);$i++)
		{
			
			if( $i==0 )
			{
				$hobbyStr.=$hobby[$i];
			}
			else
			{
				$hobbyStr.="||".$hobby[$i];
			};
		};
	};
	if( empty($_POST["reader"]) )
	{
		$msg = "请阅读用户协议";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}
	$sqlSelect = "SELECT username FROM q_user WHERE username='$userName'";
	$result = $conn->query($sqlSelect);
	if($result->num_rows>0)
	{
		$msg = '用户名已存在';
		include 'tips.php';
		exit;
	};
	
	$sql=" INSERT INTO q_user(`username`,`password`,`email`,`tel`,`province`,`sex`,`hobby`) VALUES('$userName','$password','$email','$tel','$province','$sex','$hobbyStr')";
	if($conn->query($sql)){
		$msg = "注册成功";
		$jumpUrl="../login.html";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	}else{
		$msg = "注册失败";
		include "tips.php";
		exit;//程序终止，后面的代码不执行
	};	
	
}else{
	$msg = "非法提交";
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



