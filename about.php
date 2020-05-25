<?php 

include('includes/database.php');

$tag_list = findAll('tag',"cate_id=1");

$tag_id = isset($_GET['tag_id']) ? $_GET['tag_id'] : 1;


$sql = "";
if($tag_id){
  $sql = "SELECT * FROM {$pre_}article AS art LEFT JOIN {$pre_}article_data AS data ON art.art_id=data.art_id WHERE data.tag_id = $tag_id";


  $sql_count = "SELECT count(*) AS c FROM {$pre_}article AS art LEFT JOIN {$pre_}article_data AS data ON art.art_id=data.art_id WHERE data.tag_id = $tag_id";

  $tag_where = 1;
}else{
  $sql = "SELECT * FROM {$pre_}article";

  $sql_count = "SELECT count(*) AS c FROM {$pre_}article";

  $tag_where = 1;
}
// 
$article_list = sqlAll($sql);

// var_dump($tag_id);exit;



?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title>制造工业</title>
    ﻿<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="alternate icon" type="image/png" href="assets/home/images/favicon.png">
<link rel='icon' href='favicon.ico' type='image/x-ico' />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="assets/home/css/default.min.css?t=227" />
<!--[if (gte IE 9)|!(IE)]><!-->
<script type="text/javascript" src="assets/home/lib/jquery/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="lib/amazeui/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script type="text/javascript" src="assets/home/lib/handlebars/handlebars.min.js"></script>
<script type="text/javascript" src="assets/home/lib/iscroll/iscroll-probe.js"></script>
<script type="text/javascript" src="assets/home/lib/amazeui/amazeui.min.js"></script>
<script type="text/javascript" src="assets/home/lib/raty/jquery.raty.js"></script>
<script type="text/javascript" src="assets/home/js/main.min.js?t=1"></script>
</head>
<body>
    <?php include('header.php');?>

    <div class="com-banner">
        <img src="assets/home/images/index_banner.jpg"/>
    </div>

    <div class="com-container">
        <div class="cms-g">
             <div class="am-hide-sm-only am-u-md-3 am-u-lg-3">
                 <div class="com-nav-left">
                     <h1><em>关于我们</em><i>ABOUT US</i></h1>
                     <?php foreach($tag_list as $item){?>
                        <ul >

                            
                            <li class="<?php echo $tag_id==$item['tag_id'] ? "on":"";?>"><a href="about.php?tag_id=<?php echo $item['tag_id'];?>"><?php echo $item['tag_name'];?></a></li>

                        </ul>
                        <?php }?>
                     </div>
             </div>
            <div class="am-u-sm-12 am-u-md-9 am-u-lg-9">
            <?php foreach($article_list as $item){?>
                <div class="com-nav-title">
                    <a href="about.php?art_id=<?php echo $item['art_id'];?>?art_id=<?php echo $item['art_id'];?>" class="font am-show-sm-only" data-am-offcanvas>&#xe68b;</a>
                    <span><?php echo $item['art_title'];?></span>
                </div>
                <div class="com-nav-content">
                   <?php echo $item['art_content'];?>
                </div>
                <?php }?>
            </div>
        </div>
    </div>

    <?php include('footer.php');?>
</body>
</html>