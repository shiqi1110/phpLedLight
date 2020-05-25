<?php
include('../includes/database.php');
include('check_admin.php');

$art_id = isset($_GET['art_id']) ? $_GET['art_id'] : false;

if(!$art_id)
{
    header("Location:article_list.php");
    exit;
}

//文章的详细信息
$info = findOne("article","art_id = $art_id");

//查询文章所关联的关系表
$info_tags = findAll("article_data","art_id = $art_id");

//存放的是文章被选择标签id
$tagId = array();
foreach ($info_tags as $item)
{
    $tagId[]=$item['tag_id'];
}

//查询出当前文章所选的分类下面的标签
$cate_tags = findAll("tag","cate_id = ".$info['cate_id']);


//查询所有的分类
$cate_list = findAll("cate");

//ajax查询的标签
if(isset($_POST['action']) && isset($_POST['action']) == "getTag")  //ajax 获取指定分类的标签
{
    $cate_id = $_POST['cate_id'];
    $tag_list = findAll("tag","cate_id = $cate_id");
    //json_encode();   //将php数据变成json
    //json_decode($str);   //将json的数据变成php的数组或者对象
    echo json_encode($tag_list);
    exit;
}




//先判断是否有post过来数据
if($_POST)
{
    $data = array(
        "art_title"=>$_POST['art_title'],
        "art_stitle"=>$_POST['art_stitle'],
        "art_time"=>strtotime($_POST['art_time']),  //将标准时间转化为时间戳
        "art_author"=>$_POST['art_author'],
        "art_content"=>$_POST['art_content'],
        "cate_id"=>$_POST['cate_id'],
    );

    //判断是否有上传图片过来
    if($_FILES['art_img']['size'] > 0)
    {
        $filename = upload_file("art_img","../uploads");
        $data['art_img'] = "uploads/".$filename;
    }

    $affect_id = updateData("article",$data,"art_id = $art_id");

    if(!$affect_id)
    {
        @show_msg('更新文章失败',"article_edit.php?art_id=$art_id");
        exit;
    }

    //删除掉之前选中的所有标签
    deleteData("article_data","art_id = $art_id");

    $tag_id = $_POST['tag_id'];  //获取所选中的标签
    $total_tags = 0;
    //重新插入一份标签
    foreach($tag_id as $item){
        $data = array(
              "art_id"=>$art_id,
              "tag_id"=>$item,
        );
        $dataId = insertData("article_data",$data);

        $total_tags = $dataId ? ++$total_tags : $total_tags;
    }

    if($total_tags == count($tag_id))
    {
        @show_msg('更新文章成功','article_list.php');
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
            <h1 class="page-title">发布文章</h1>
        </div>
                <ul class="breadcrumb">
            <li><a href="index.php">Home</a> <span class="divider">/</span></li>
            <li class="active">发布文章</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    <button class="btn btn-primary" onClick="location='article_list.php'"><i class="icon-list"></i> 文章列表</button>
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form class="article_add" action="#" method="post" enctype="multipart/form-data">
            <label>文章标题</label>
            <input type="text" datatype="s4-25" value="<?php echo $info['art_title'];?>" name="art_title" class="input-xxlarge">
            <label>小标题</label>
            <input type="text" value="<?php echo $info['art_stitle'];?>" name="art_stitle" class="input-xxlarge">
            <label>发布时间</label>
            <input type="date" value="<?php echo date("Y-m-d",$info['art_time']);?>" name="art_time" class="input-xxlarge">
            <label>文章作者</label>
            <input type="text" value="<?php echo $info['art_author'];?>" name="art_author" class="input-xxlarge">
            <label>文章图片</label>
            <input type="file" value="" name="art_img" class="input-xxlarge">
            <?php if(!empty($info['art_img'])){?>
                <img src="../<?php echo $info['art_img']?>" style="width:200px;height:200px" />
            <?php }?>

            <label>文章分类</label>
            <select onchange="getTag(this)" name="cate_id" class="input-xlarge" required>
                <option value="">请选择</option>
                <?php foreach($cate_list as $item){?>
                <option <?php echo $info['cate_id']==$item['cate_id']?"selected":"";?> value="<?php echo $item['cate_id'];?>"><?php echo $item['cate_name'];?></option>
                <?php }?>
            </select>
            <label>文章标签</label>
            <div id="tag_list">
                <?php foreach($cate_tags as $item){?>
                    <input type="checkbox" <?php echo in_array($item['tag_id'],$tagId) ? "checked":"";?> name="tag_id[]" value="<?php echo $item['tag_id']?>" class="input-xxlarge" /><?php echo $item['tag_name'];?>&nbsp;
                <?php }?>
            </div>
            <label>文章基本信息</label>
            <textarea value="Smith" name="art_message" rows="3" class="input-xxlarge"><?php echo $info['art_message'];?></textarea>
            <label>文章内容</label>
            <textarea value="Smith" name="art_content" rows="3" class="input-xxlarge"><?php echo $info['art_content'];?></textarea>
            
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

        //表单验证
        $(".article_add").Validform();

        function getTag(obj)
        {
            var cate_id = obj.value;

            if(cate_id)
            {
                $.ajax({   //从服务器端返回来的数据是什么类型
                    type:"post",
                    data:'cate_id='+cate_id+"&action=getTag",
                    dataType:"json",   //从服务器返回来的数据类型
                    url:'article_add.php',
                    success:function(data){
                        var tag_list = '';
                        for(k in data)
                        {
                            tag_list += "<input type='checkbox' class='input-xxlarge' name='tag_id[]' value='"+data[k]['tag_id']+"' />"+data[k]['tag_name']+"&nbsp;";

                        }
                        document.getElementById('tag_list').innerHTML = tag_list;
                    }
                });
            }
        }
    </script>
    
  </body>
</html>


