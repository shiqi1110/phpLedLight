<?php
include('../includes/database.php');
include('check_admin.php');

$cate_id = isset($_GET['cate_id']) ? $_GET['cate_id'] : false;
if(!$cate_id){
    header("Location:cate_list.php");
    exit;
}

// //文章的详细信息
$info = findOne("cate","cate_id = $cate_id");


//查询所有的分类
$cate_list = findAll("cate");


//先判断是否有post过来数据
if($_POST)
{
    $data = array(
        "cate_id"=>$_POST['cate_id'],
        "cate_name"=>$_POST['cate_name'],
    );


    $affect_id = updateData("cate",$data,"cate_id = $cate_id");

    if($affect_id)
    {
        @show_msg('编辑标签成功',"cate_list.php");
        exit;
    }else{
        @show_msg('编辑标签失败',"cate_edit.php?cate_id=$cate_id");
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
            <h1 class="page-title">分类管理</h1>
        </div>
                <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">分类管理</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    <button class="btn btn-primary" onClick="location='cate_list.php'"><i class="icon-list"></i> 文章列表</button>
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form class="cate_add" action="#" method="post" enctype="multipart/form-data">
            <label>分类名称</label>
            <input type="text" datatype="s4-25" value="<?php echo $info['cate_name'];?>" name="cate_name" class="input-xxlarge">
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


