<?php
error_reporting(E_ALL ^E_WARNING);

$conn = mysqli_connect("localhost","root","root") or die("数据库链接失败");

mysqli_select_db($conn,"ledlight");

mysqli_query($conn,"SET NAMES UTF8");

$pre_ = "pre_";

include("helpers.php");
?>