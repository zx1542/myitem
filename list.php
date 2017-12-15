<?php
session_start();
header('Content-type:text/html;charset=utf8');
$conn = new mysqli('localhost','root','root','myitem');

if($conn->error)
{
	die('数据库连接失败');
};
$pageSize = 5;//每页显示的条数
if(empty($_GET['page'])){
	$pages=1;
	$pageStart=($pages-1)*$pageSize;//(1-1)*4=0;
}else{
	$pages=$_GET['page'];
	$pageStart = ($pages-1)*$pageSize;
};




if(empty($_GET['column'])){
	$column = '全部内容';
}else{
	$column=$_GET['column'];
};

if($column=='全部内容'){
	$sql="SELECT * FROM h_content LIMIT $pageStart,$pageSize";
	$sqlTotal="SELECT * FROM h_content ";
}else{
	$sqlTotal="SELECT * FROM h_content WHERE `column` = '$column'";
	$sql="SELECT * FROM h_content WHERE `column` = '$column' LIMIT $pageStart,$pageSize";
};

$result = $conn->query($sql);
$resultTotal=$conn->query($sqlTotal);
$i=0;

$totalNum=$resultTotal->num_rows;//数据总条数
$pageNum=ceil($totalNum/$pageSize);//总页数

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        #nav{border-bottom:1px solid #080808;margin-bottom:0;}
        .list{margin-bottom:40px;padding-left:15px;}
        .list-pagination{width:100%;text-align:center;}
        .list li{line-height:30px;}
        #bread{margin-bottom:40px;}
        footer{width:100%;background:#f5f5f5;border-top:1px solid #ddd;padding:10px 0;}
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse" id="nav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">首页</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="qdzx.php">前端资讯 <span class="sr-only">(current)</span></a></li>
                <li><a href="kcxz.php">课程选择</a></li>
                <li><a href="list.php">课程列表</a></li>
                <li><a href="vote.php">投票</a></li>
                <li><a href="search.php">搜索</a></li>
                <?php
					if(!empty($_SESSION['user'])){
					?>
					<li><a href="javascript:void;">欢迎您：<?php echo $_SESSION['user']; ?></a></li>
					<li><a href="php/loginout.php">注销</a></li>
					<?php
					}else if(!empty($_COOKIE['user'])){
					?>
					<li><a href="javascript:void;">欢迎您：<?php echo $_COOKIE['user']; ?></a></li>
					<li><a href="php/loginout.php">注销</a></li>
					<?php	
					}else{
					?>
					<li><a href="register.html">注册</a></li>
					<li><a href="login.html">登录</a></li>
					<?php	
					}
					?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="">关于我们</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
<div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="images/kcxz_03.jpg" alt="">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <img src="images/kcxz_04.jpg" alt="">
                <div class="carousel-caption">
                </div>
            </div>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <ol class="breadcrumb" id="bread">
        <li><a href="index.php">首页</a></li>
        <li class="active"><?php echo $column;?></li>
    </ol>
    <h2><?php echo $column;?></h2>
    <hr>
    <ul class="list-unstyled list">
       <?php
		if($result->num_rows>0){
			while($rows=$result->fetch_assoc()){
				$i++;
		?>
		<li><a href="content.php?id=<?php echo $rows['id'];?>" target="_blank"><?php echo $rows['title'];?></a><span class="pull-right"><?php echo $rows['add_date'];?></span>
		</li>
		<?php
				if($i%5==0){
					echo '<br>';
				};	
			};
		}else{
			echo '没有数据';
		};
		?>
    </ul>
    <div class="row list-pagination">
        <ul class="pagination">
            <li>
                <a  class="<?php if($pages==1){echo 'btn disabled';};?>" href="list.php?column=<?php echo $column; ?>&page=<?php echo $pages-1;?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
			for($j=1;$j<=$pageNum;$j++){
			?>
			<li class="<?php if($pages==$j){echo 'active';};?>"><a href=" list.php?column=<?php echo $column;?>&page=<?php echo $j;?>"><?php echo $j; ?></a></li>
			<?php		
			}
			?>
            <li>
                <a class="<?php if($pages==$pageNum){echo 'btn disabled';};?>" href="list.php?column=<?php echo $column;?>&page=<?php echo $pages+1;?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
    <footer>
        Copyright1999-2016北京中公教育科技股份有限公司.All Rights Reserved 京ICP证161188号
    </footer>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>