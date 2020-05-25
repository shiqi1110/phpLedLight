<?php
include('../includes/database.php');
include('check_admin.php');


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

    <script src="../assets/admin/lib/jquery-1.7.2.min.js" type="text/javascript"></script>

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

    <?php include('header.php');?>

    <?php include('menu.php');?>

    <div class="content">
        <div class="header">
            <h1 class="page-title">后台首页</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">Index</li>
        </ul>

        <ul>
            <li>PHP版本：<?php echo PHP_VERSION;?></li>
            <li>服务器信息：<?php echo $_SERVER['SERVER_SOFTWARE'];?></li>
            <li>数据库信息：<?php echo mysqli_get_client_info();?></li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    <footer>
                        <hr>
                    </footer>
                    
            </div>
        </div>
    </div>
    


    <script src="../assets/admin/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


