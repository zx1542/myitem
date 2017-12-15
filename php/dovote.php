<?php
header("content-type:text/html;charset=utf8");
$conn = new mysqli('localhost','root','root','myitem');
if($conn->error){
	die('无法注册');
};
$vote=$_GET['vote'];
$str = file_get_contents('vote.txt');//读取文件
$dataArr = explode('|',$str);//分割字符串为数组
switch($vote){
	case 0:
	$dataArr[0]++;
	break;
	
	case 1:
	$dataArr[1]++;
	break;
	case 2:
	$dataArr[2]++;
	break;
	
	case 3:
	$dataArr[3]++;
	break;
	
	case 4:
	$dataArr[4]++;
	break;
	
	case 5:
	$dataArr[5]++;
	break;
	
	case 6:
	$dataArr[6]++;
	break;
};
$totalVote = $dataArr[0]+$dataArr[1]+$dataArr[2]+$dataArr[3]+$dataArr[4]+$dataArr[5]+$dataArr[6];//计算总票数
//计算各组的百分比
$pc = round(($dataArr[0]/$totalVote)*100,2);
$yd = round(($dataArr[1]/$totalVote)*100,2);
$js = round(($dataArr[2]/$totalVote)*100,2);
$jq = round(($dataArr[3]/$totalVote)*100,2);
$bt = round(($dataArr[4]/$totalVote)*100,2);
$an = round(($dataArr[5]/$totalVote)*100,2);
$h5 = round(($dataArr[6]/$totalVote)*100,2);
$resultStr = implode('|',$dataArr);//把数组以相应的分隔符拼接成字符串
file_put_contents('vote.txt',$resultStr);//替换文件
?>
   	<h2>各个科目受欢迎的百分比</h2>
    <h5>此数据来源于网络<?php echo $totalVote;?>份用户投票结果</h5>
	<p class="h3">PC端网站重构（<?php echo $pc;?>%）</p>
    <div class="progress">
        <div class="progress-bar 
           <?php
				if($pc<25)
				{
					echo 'progress-bar-success';
				}
				else if($pc>=25&&$pc<50)
				{
					echo 'progress-bar-info';
				}
				else if($pc>=50&&$pc<75)
				{
					echo 'progress-bar-warning';
				}
				else
				{
					echo 'progress-bar-danger';
				};
			?>
           progress-bar-striped" role="progressbar" style="width: <?php echo $pc;?>%">
            <span class="sr-only"><?php echo $pc;?>% Complete (success)</span>
        </div>
    </div>
    <p class="h3">移动端网站重构（<?php echo $yd;?>%）</p>
    <div class="progress">
        <div class="progress-bar 
           <?php
				if($yd<25)
				{
					echo 'progress-bar-success';
				}
				else if($yd>=25&&$yd<50)
				{
					echo 'progress-bar-info';
				}
				else if($yd>=50&&$yd<75)
				{
					echo 'progress-bar-warning';
				}
				else
				{
					echo 'progress-bar-danger';
				};
			?>
           progress-bar-striped" role="progressbar" style="width: <?php echo $yd;?>%">
            <span class="sr-only"><?php echo $yd;?>% Complete (success)</span>
        </div>
    </div>
    <p class="h3">JavaScript（<?php echo $js;?>%）</p>
    <div class="progress">
        <div class="progress-bar 
           <?php
				if($js<25)
				{
					echo 'progress-bar-success';
				}
				else if($js>=25&&$js<50)
				{
					echo 'progress-bar-info';
				}
				else if($js>=50&&$js<75)
				{
					echo 'progress-bar-warning';
				}
				else
				{
					echo 'progress-bar-danger';
				};
			?>
           progress-bar-striped" role="progressbar" style="width: <?php echo $js;?>%">
            <span class="sr-only"><?php echo $js;?>% Complete (success)</span>
        </div>
    </div>
    <p class="h3">JQuery（<?php echo $jq;?>%）</p>
    <div class="progress">
        <div class="progress-bar 
           <?php
				if($jq<25)
				{
					echo 'progress-bar-success';
				}
				else if($jq>=25&&$jq<50)
				{
					echo 'progress-bar-info';
				}
				else if($jq>=50&&$jq<75)
				{
					echo 'progress-bar-warning';
				}
				else
				{
					echo 'progress-bar-danger';
				};
			?>
           progress-bar-striped" role="progressbar" style="width: <?php echo $jq;?>%">
            <span class="sr-only"><?php echo $jq;?>% Complete (success)</span>
        </div>
    </div>
    <p class="h3">Bootstrap（<?php echo $bt;?>%）</p>
    <div class="progress">
        <div class="progress-bar 
           <?php
				if($bt<25)
				{
					echo 'progress-bar-success';
				}
				else if($bt>=25&&$bt<50)
				{
					echo 'progress-bar-info';
				}
				else if($bt>=50&&$bt<75)
				{
					echo 'progress-bar-warning';
				}
				else
				{
					echo 'progress-bar-danger';
				};
			?>
           progress-bar-striped" role="progressbar" style="width: <?php echo $bt;?>%">
            <span class="sr-only"><?php echo $bt;?>% Complete (success)</span>
        </div>
    </div>
    <p class="h3">Angular（<?php echo $an;?>%）</p>
    <div class="progress">
        <div class="progress-bar 
           <?php
				if($an<25)
				{
					echo 'progress-bar-success';
				}
				else if($an>=25&&$an<50)
				{
					echo 'progress-bar-info';
				}
				else if($an>=50&&$an<75)
				{
					echo 'progress-bar-warning';
				}
				else
				{
					echo 'progress-bar-danger';
				};
			?>
           progress-bar-striped" role="progressbar" style="width: <?php echo $an;?>%">
            <span class="sr-only"><?php echo $an;?>% Complete (success)</span>
        </div>
    </div>
    <p class="h3">H5高级课程（<?php echo $h5;?>%）</p>
    <div class="progress">
        <div class="progress-bar 
           <?php
				if($h5<25)
				{
					echo 'progress-bar-success';
				}
				else if($h5>=25&&$h5<50)
				{
					echo 'progress-bar-info';
				}
				else if($h5>=50&&$h5<75)
				{
					echo 'progress-bar-warning';
				}
				else
				{
					echo 'progress-bar-danger';
				};
			?>
           progress-bar-striped" role="progressbar" style="width: <?php echo $h5;?>%">
            <span class="sr-only"><?php echo $h5;?>% Complete (success)</span>
        </div>
    </div>