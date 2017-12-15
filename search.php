<?php
session_start();
header('Content-type:text/html;charset=utf8');
$conn = new mysqli('localhost','root','root','myitem');

if($conn->error)
{
	die('数据库连接失败');
};
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
        #bread{margin-bottom:70px;}
        form{margin-bottom:100px;text-align: center;}
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
                <li><a href="search.html">搜索</a></li>
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
        <li class="active">搜索</li>
    </ol>
    <form class="form-inline" action="search_list.php" method="get">
        <div class="form-group">
            <label class="sr-only" for="exampleInputSearch3">Email address</label>
            <input type="search" name="q" class="form-control" placeholder="请输入要搜索的内容">
        </div>
        <button type="submit" class="btn btn-default" id="but">搜索</button>
    </form>
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