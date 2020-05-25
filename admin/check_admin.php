<?php 
session_start();
if(!isset($_SESSION['admin_name']) || empty($_SESSION['admin_name'])){
	show_msg('重新登录','login.php');
	exit;
}	



?>