<?php
session_start();
unset($_SESSION['username']);
$msg = '成功退出';
$jumpUrl = 'admin.php';
include 'tips.php';
exit;
?>