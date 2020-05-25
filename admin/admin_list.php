<?php
include('../includes/database.php');
include('check_admin.php');

//接收页码id
$page = isset($_GET['page']) ? $_GET['page'] : 1;

//总数
$sql = "SELECT count(*) AS c FROM {$pre_}admin";
$count = sqlOne($sql);

//每页显示多少条数据
$limit = 5;

//中间显示的页码数
$size = 5;

//调用分页函数
$page_str = page($page,$count['c'],$limit,$size);

//偏移量
$start = ($page-1)*$limit;

//查询数据
$sql = "SELECT * FROM {$pre_}admin LIMIT $start,$limit";
$admin_list = sqlAll($sql);

if(isset($_GET['admin_id']))
{
    $admin_id = $_GET['admin_id'];
    $admin = deleteData("admin","admin_id = $admin_id");
   

    if($admin)
    {
        show_msg('删除用户名成功','admin_list.php');
        exit;
    }else{
        show_msg('删除用户名失败','admin_list.php');
        exit;
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
    <link rel="stylesheet" href="../assets/page/css.css">

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
            <h1 class="page-title">管理员列表</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">List</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    <button class="btn btn-primary" onClick="location='admin_add.php'"><i class="icon-plus"></i>管理员列表</button>
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>会员名</th>
          <th>密码</th>
          <th>注册时间</th>
          <th style="width: 50px;"></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($admin_list as $item){?>
        <tr>
          <td><?php echo $item['admin_id'];?></td>
          <td><?php echo $item['admin_name'];?></td>
          <td><?php echo $item['admin_pwd'];?></td>
          <td><?php echo date("Y-m-d", $item['admin_time']);?></td>
          <td>
              <a href="admin_edit.php?admin_id=<?php echo $item['admin_id'];?>"><i class="icon-pencil"></i></a>
              <a onclick="delete_admin('<?php echo $item['admin_id'];?>')" href="javascript:void(0)"><i class="icon-remove"></i></a>
          </td>
        </tr>
        <?php }?>
       
      
      </tbody>
    </table>
</div>
<div class="pagination">
   <?php echo $page_str;?>
</div>

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
    </div>
</div>


                    
                    <footer>
                        <hr>
                        <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                        <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                        

                        <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
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

          function delete_admin(admin_id){
          if(confirm('是否确认删除')){
            window.location.href="admin_list.php?admin_id="+admin_id;
          }
        }
    </script>
    
  </body>
</html>


