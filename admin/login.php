<?php
include('../includes/database.php');

if(isset($_GET['action']) && $_GET['action'] == 'logout')
{
    //退出登录的操作
    session_start();
    session_destroy();  //当使用这个方法的时候前，开启回话才能清除
    show_msg('退出成功','login.php');
    exit;
}


if($_POST)
{
    $admin_name = $_POST['admin_name'];
    $admin_pwd = md5($_POST['admin_pwd']);
    $imgcode = $_POST['imgcode'];

    //开启会话
    session_start();

    //判断验证码是否输入正确
    if($imgcode != $_SESSION['imgcode'])
    {
        show_msg('验证码输入错误','login.php');
        exit;
    }



    $sql = "SELECT * FROM {$pre_}admin WHERE admin_name = '$admin_name' AND admin_pwd = '$admin_pwd'";
    $admin_info = sqlOne($sql);

    if(empty($admin_info))
    {
        show_msg("登录失败请重新登录","login.php");
        exit;
    }else{   //登录成功的操作
        $_SESSION['admin_name'] = $admin_info['admin_name'];
        show_msg('登录成功','index.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Blog Admin</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="../assets/admin/lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="../assets/admin/stylesheets/theme.css">
    <link rel="stylesheet" href="../assets/admin/lib/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/validform/style.css" />

    <script src="../assets/admin/lib/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="../assets/validform/Validform_v5.1_min.js"></script>

    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>
  </head>

  <body class="">
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                </ul>
                <a class="brand" href="index.html"><span class="first">Blog</span> <span class="second">Admin</span></a>
        </div>
    </div>
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">登录</p>
            <div class="block-body">
                <form action="#" method="post" class="loginForm">
                    <label>用户名</label>
                    <input type="text" datatype="*3-15" errormsg="用户名长度有问题" class="span12" name="admin_name">
                    <label>密码</label>
                    <input type="password" datatype="*3-15" errormsg="密码长度有问题" class="span12" name="admin_pwd">
                    <label>验证码</label>
                    <input type="text" datatype="*" errormsg="验证码输入有误" class="span12" name="imgcode">
                    <img src="imgcode.php" onclick="this.src='imgcode.php?date='+Date.parse(new Date());" />
                    <button type="submit" class="btn btn-primary pull-right">登录</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>


    


    <script src="../assets/admin/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });

        $(".loginForm").Validform();
    </script>
    
  </body>
</html>


