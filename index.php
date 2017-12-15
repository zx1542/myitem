<?php
session_start();
header('Content-type:text/html;charset=utf8');
//返回一个object类型 num_rows 如果这个属性是大于0则表明查询成功
$conn = new mysqli('localhost','root','root','myitem');

if($conn->error)
{
	die('数据库连接失败');
};
$sql = "SELECT * FROM h_content ORDER BY id DESC LIMIT 8";

$result = $conn->query($sql);
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
			footer{width:100%;background:#f5f5f5;border-top:1px solid #dddddd;padding:10px 0;}
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
        <div>
            <p class="h2"><strong>Web</strong>前端课程推荐</p>
            <p>这些项目或者是对Bootstrap进行了有益的研究，或者是基于Bootstrap开发的</p>
        </div>
        <hr>
        <div class="row">
		<?php
			if($result->num_rows>0){
			while($rows = $result->fetch_assoc()){
			?>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<a href="content.php?id=<?php echo $rows['id'];?>" target="_blank"><img src="<?php echo $rows['thumb'];?>" target="_blank" title="<?php echo $rows['title'];?>" width="252" height="142"></a>
					<div class="caption">
						<h3>
                			<a href="content.php?id=<?php echo $rows['id'];?>" target="_blank" title="<?php echo $rows['title'];?>"><?php echo mb_substr($rows['title'],0,8,'utf8');?></a><br><small><a href="list.php?column=<?php echo $rows['column'];?>" target="_blank"><?php echo $rows['column'];?></a></small>
              			</h3>
						<p><?php echo mb_substr($rows['description'],0,40,'utf8').'...';?></p>
					</div>
				</div>
            </div>
			<?php	
			}
			}
			?>
        </div>
        <div>
            <p class="h2"><strong>Web</strong>前端课程推荐</p>
            <p>这些项目或者是对Bootstrap进行了有益的研究，或者是基于Bootstrap开发的</p>
        </div>
        <hr>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>班级名称</th>
                <th>课时</th>
                <th>价格</th>
                <th>免费试听</th>
                <th>购买课程</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>就业精品班（面授/封闭班/包食宿）</td>
                <td>4个月</td>
                <td>优惠价17800.00<del>原价17800.00</del></td>
                <td><a href="#"><span class="glyphicon glyphicon-headphones">预约</span></a></td>
                <td><button type="button" class="btn btn-danger">立即报名</button></td>
            </tr>
            <tr>
                <td>软件基础课程（网课/远程教学班）</td>
                <td>96</td>
                <td>优惠价580.00<del>原价980.00</del></td>
                <td><a href="#"><span class="glyphicon glyphicon-headphones">预约</span></a></td>
                <td><button type="button" class="btn btn-danger">立即报名</button></td>
            </tr>
            <tr>
                <td>Dreamweaver网页制作基础</td>
                <td>41</td>
                <td>优惠价399.00<del>原价499.00</del></td>
                <td><a href="#"><span class="glyphicon glyphicon-headphones">预约</span></a></td>
                <td><button type="button" class="btn btn-danger">立即报名</button></td>
            </tr>
            </tbody>
        </table>
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