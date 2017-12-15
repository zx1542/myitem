<?php
session_start();
header("content-type:text/html;charset=utf8");
$conn=new mysqli('localhost','root','root','myitem');
if($conn->error){
	die('数据库连接失败');
};
$q = $_GET['q'];
$pageSize=4;
if(empty($_GET['page'])){
	$pages=1;
	$pageStart=($pages-1)*$pageSize;
}else{
	$pages=$_GET['page'];
	$pageStart=($pages-1)*$pageSize;
}
if($q=='全部课程'){
	$sqlTotal="SELECT * FROM h_content ";
	$sql="SELECT * FROM h_content LIMIT $pageStart,$pageSize";
}else{
	$sqlTotal="SELECT * FROM h_content WHERE `column` = '$q'";
	$sql="SELECT * FROM h_content WHERE `column` = '$q' LIMIT $pageStart,$pageSize";
}
$result = $conn->query($sql);
$resultTotal=$conn->query($sqlTotal);

$totalNum=$resultTotal->num_rows;//数据总条数
$pageNum=ceil($totalNum/$pageSize);//总页数
if($result->num_rows>0){
	while($rows=$result->fetch_assoc()){
?>
<div class="col-xs-6 col-md-3">
    <a href="content.php?id=<?php echo $rows['id'];?>" class="thumbnail" target="_blank">
    	<img src="<?php echo $rows['thumb']; ?>" width="100%" alt="<?php echo $rows['title']; ?>">
    </a>
</div>
<?php		
	};

}else{
	echo '没有查询到您要的课程';
};
?>
<br><br><br><br><br><br><br><br>
<ul class="pager" id="page">
	<li class="previous"><a class="<?php if($pages==1){echo 'btn disabled';};?>" href="kcxz.php?q=<?php echo $q;?>&page=<?php echo $pages-1;?>"><span aria-hidden="true">&larr;</span> Older</a></li>

	<li class="next"><a class="<?php if($pages==$pageNum){echo 'btn disabled';};?>" href="kcxz.php?q=<?php echo $q;?>&page=<?php echo $pages+1;?>">Newer <span aria-hidden="true">&rarr;</span></a></li>
</ul>