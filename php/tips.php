<?php
header("Content-type:text/html;charset=utf8");	

?>
<br>
<div>
	<h3><?php echo $msg; ?></h3>
	<p>还有<span id="nums">5</span>秒跳转。如果不想等待请点击<a href="<?php echo $jumpUrl; ?>">跳转</a></p>
</div>
<script>
var oNum = document.getElementById('nums');
var oA = document.getElementsByTagName('a')[0];

var timer = null;
oNums = oNum.innerHTML;
console.log( oNums );
timer = setInterval(function(){
	
	oNums--;
	
	if(oNums==0)
	{
		window.location = oA.href;
	};
	
	oNum.innerHTML = oNums;
	
},1000);
</script>
<style>
	div{width:200px;height:100px;margin:0 auto;border:2px solid red;;background:pink}
	h3{width:200px;height:40px;background:black;color:red;margin:0 0;text-align:center;}
	p{width:200px;height:60px;font-size:20px;color:black;line-height:30px;margin:0 0;}
	div span{color:red;font-size:30px;}
	p a{color:blue;font-size:24px;}
</style>