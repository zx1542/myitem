<?php
session_start();
header("Content-type:text/html;charset=utf8");	
$conn = new mysqli('localhost','root','root','myitem');
if($conn->error){
	die('注册失败1');
};
$id = $_POST['aid'];
$msg = "";
$jumpUrl = "column.php";
$dir="../images/";
if($_SERVER['REQUEST_METHOD']=='POST'){
	$title = $_POST['title'];
	$username=$_SESSION['username'];
	$column = $_POST['column'];
	$description = $_POST['description'];
	$keywords = $_POST['keywords'];
	$contents = $_POST['editorValue'];
	
	/*$sql= "UPDATE h_content SET `title`='$title',`column`='$column',`description`='$description',`keywords`='$keywords',`contents`='$contents',`thumb`='$thumb' WHERE id=$id";
	$result=$conn->query($sql);*/

	
	if($_FILES['upfile']['error']==0){
		$fileMaxSize = 1*1024*1024;
		if($_FILES['upfile']['size']>$fileMaxSize){
			$msg = '上传文件过大';
			$jumpUrl = 'publish.php';
			include 'tips.php';
			exit;
		};
		$imgArr=['image/jpeg','image/png','image/gif'];
		$fileType=$_FILES['upfile']['type'];
		if(!in_array($fileType,$imgArr)){
			$msg = '文件类型错误';
			$jumpUrl = 'publish.php';
			include 'tips.php';
			exit;
		};
		$fileNameArr=explode('.',$_FILES['upfile']['name']);
		$fileSuffix=array_pop($fileNameArr);
		$newFileName=date('YmdHis').rand(1000,9999).'.'.$fileSuffix;
		move_uploaded_file($_FILES['upfile']['tmp_name'],$dir.$newFileName);
		$thumb = 'images/'.$newFileName;
		$dtime = date('Y-m-d H:i:s',time());
		
		$sql= "UPDATE h_content SET `title`='$title',`column`='$column',`description`='$description',`keywords`='$keywords',`contents`='$contents',`thumb`='$thumb' WHERE id=$id";
		if($conn->query($sql)){
			$msg = '修改成功';
			$jumpUrl = 'column.php';
			include 'tips.php';
			exit;
		}else{
			echo $conn->error;
		};
		
	}else{
		$sql= "UPDATE h_content SET `title`='$title',`column`='$column',`description`='$description',`keywords`='$keywords',`contents`='$contents' WHERE id=$id";
		if($conn->query($sql)){
			$msg = '修改成功';
			$jumpUrl = 'column.php';
			include 'tips.php';
			exit;
		}else{
			echo $conn->error;
		};
	}
}else{
	$msg = '不允许非法提交';
	$jumpUrl = 'publish.php';
	include 'tips.php';
	exit;
}
	
?>
