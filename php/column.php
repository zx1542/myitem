<?php
include 'h_header.php';
$conn=new mysqli('localhost','root','root','myitem');
if($conn->error){
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
        <div class="row">
        	<div class="col-md-3">
            	<ul class="list-group">
                  <li class="list-group-item list-group-item-success">文章栏目</li>
                  <li class="list-group-item"><a href="column.php?column=<?php echo 'Web前端开发';?>">Web前端开发</a></li>
                  <li class="list-group-item"><a href="column.php?column=<?php echo 'UI设计';?>">UI设计</a></li>
                  <li class="list-group-item"><a href="column.php?column=<?php echo 'PHP开发';?>">PHP开发</a></li>
                  <li class="list-group-item"><a href="column.php?column=<?php echo 'JAVA开发';?>">JAVA开发</a></li>
                  <li class="list-group-item"><a href="column.php?column=<?php echo '网络营销';?>">网络营销</a></li>
                  <li class="list-group-item list-group-item-success"><a href="publish.php">发布文章</a></li>
                </ul>
            </div>
            <div class="col-md-9" style="border-left:1px solid #eaeaea;">
            
            	<table class="table">
                    <tr>
                        <th>id</th>
                        <th>文章标题</th>
                        <th>发布日期</th>
                        <th>操作</th>
                    </tr>
                   <?php
					if($result->num_rows>0){
						while($rows=$result->fetch_assoc()){
					?>
					<tr>
                        <td><?php echo $rows['id'];?></td>
                        <td><?php echo $rows['title'];?></td>
                        <td><?php echo $rows['add_date'];?></td>
                        <td><a href="delete.php?id=<?php echo $rows['id']; ?>">删除</a> <a href="edit.php?id=<?php echo $rows['id']; ?>">修改</a></td>
					</tr>	
					<?php		
						};
					};
					?>
                </table>

            </div>
        </div>
        <div class="row list-pagination">
        	<ul class="pagination" id="list">
				<li>
					<a  class="<?php if($pages==1){echo 'btn disabled';};?>" href="column.php?column=<?php echo $column; ?>&page=<?php echo $pages-1;?>">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>
				<?php
				for($j=1;$j<=$pageNum;$j++){
				?>
				<li class="<?php if($pages==$j){echo 'active';};?>"><a href=" column.php?column=<?php echo $column;?>&page=<?php echo $j;?>"><?php echo $j; ?></a></li>
				<?php		
				}
				?>
				<li>
					<a class="<?php if($pages==$pageNum){echo 'btn disabled';};?>" href=" column.php?column=<?php echo $column;?>&page=<?php echo $pages+1;?>">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
        	</ul>
    	</div>
	
        <div class="panel-footer" style="margin-top:50px;">
    		Copyright1999-2016 北京中公教育科技股份有限公司 .All Rights Reserved 京ICP证161188号
    	</div>
    </div>
</body>
</html>