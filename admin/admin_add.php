<?php
include('../includes/database.php');
include('check_admin.php');

//查询所有的分类
$admin_list = findAll("admin");


//先判断是否有post过来数据
if($_POST)
{
    $data = array(
        "admin_name"=>$_POST['admin_name'],
        "admin_time"=>strtotime($_POST['admin_time']),  //将标准时间转化为时间戳
        "admin_pwd"=>$_POST['admin_pwd'],
    );
    foreach($admin_list as $item){
        if($_POST['admin_name'] == $item['admin_name']){
            show_msg('用户名存在','admin_add.php');
            exit;
        }
    }
    $insertId = insertData("admin",$data);
    // var_dump($insertId);exit;

    if($insertId){
        show_msg('插入成功','admin_list.php');
        exit;
    }else{
        show_msg('插入失败','admin_add.php');
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
    
    <?php include('header.php');?>

    <?php include('menu.php');?>
    <div class="content">
        <div class="header">
            <h1 class="page-title">添加用户名</h1>
        </div>
                <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">标签管理</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    <button class="btn btn-primary" onClick="location='admin_list.php'"><i class="icon-list"></i> 标签管理</button>
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form class="admin_add" action="#" method="post" enctype="multipart/form-data">
            <label>用户名</label>
            <input type="text" datatype="s4-25" value="" name="admin_name" class="input-xxlarge">
            <label>密码</label>
            <input type="text" datatype="s4-50" value="" name="admin_pwd" class="input-xxlarge">
            <label>注册时间</label>
            <input type="date" value="<?php echo date("Y-m-d");?>" name="admin_time" class="input-xxlarge">
            <label></label>
            <input class="btn btn-primary" type="submit" value="提交" />
        </form>
      </div>
  </div>

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


