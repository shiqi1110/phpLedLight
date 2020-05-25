<?php 

include('includes/database.php');

$tag_list = findAll('tag','cate_id=4');

$tag_id = isset($_GET['tag_id']) ? $_GET['tag_id'] : 13;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$size = 5;
$limit = 4;
$start = ($page - 1)*$limit;
$sql = "SELECT count(*) AS c FROM {$pre_}article_data as data where data.tag_id =$tag_id ";
$count = sqlOne($sql);
$page_str = page($page,$count['c'],$limit,$size);

$where = '';
$sql = "";
$sql_count = "";
if($tag_id){
  $sql = "SELECT * FROM {$pre_}article AS art LEFT JOIN {$pre_}article_data AS data ON art.art_id=data.art_id WHERE data.tag_id = $tag_id LIMIT $start,$limit";


  $sql_count = "SELECT count(*) AS c FROM {$pre_}article AS art LEFT JOIN {$pre_}article_data AS data ON art.art_id=data.art_id WHERE data.tag_id = $tag_id";

  $tag_where = 1;
}else{
  $sql = "SELECT * FROM {$pre_}article LIMIT $start,$limit";

  $sql_count = "SELECT count(*) AS c FROM {$pre_}article";

  $tag_where = 1;
}

$article_list = sqlAll($sql);
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
        <img src="assets/home/images/index_banner.jpg" />
    </div>
    <div class="com-container">
        <div class="cms-g">
            <div class="am-hide-sm-only am-u-md-3 am-u-lg-3">
                <div class="com-nav-left">
                    <h1><em>产品应用</em><i>APPLICATION</i></h1>
                    <?php foreach($tag_list as $item){?>
                    <ul>
                        <li class="<?php echo $tag_id==$item['tag_id'] ? 'on' : '';?>"><a href="case_list.php?tag_id=<?php echo $item['tag_id'];?>"><?php echo $item['tag_name']; ?></a></li>
                    </ul>
                    <?php }?>
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-9 am-u-lg-9">
                <div class="com-nav-title">
                    <a href="#doc-oc-demo1" class="font am-show-sm-only" data-am-offcanvas>&#xe68b;</a>
                    <span>
                        <?php foreach($tag_list as $item){?>
                        <?php if($item['tag_id'] == $tag_id){ echo $item['tag_name'];}?> 
                        <?php }?>
                    </span>
                </div>
                <div class="case-list">
                <?php foreach($article_list as $item){?>
                    <div class="am-u-sm-6 am-u-md-4 am-u-lg-3">
                        <div class="case-list-item">
                            <a href="case_info.php?tag_id=<?php echo $tag_id;?>&art_id=<?php echo $item['art_id'];?>"><img src="<?php echo $item['art_img'];?>" /><span><?php echo $item['art_title'];?></span></a>
                           
                        </div>
                    </div>
                    <?php }?>

                </div>
                <div class="page-list">
                    <?php echo $page_str;?>
                </div>
            </div>
        </div>
    </div>
    <div id="doc-oc-demo1" class="am-offcanvas">
        <div class="am-offcanvas-bar">
            <div class="am-offcanvas-content com-nav-left com-nav-left1">
                <ul>
                    <li class="on"><a href="#">照明应用</a></li>
                    <li><a href="#">场景体验</a></li>
                    <li><a href="#">照明案例</a></li>
                </ul>
            </div>
        </div>
    </div>
    ﻿
    <?php include('footer.php');?>
</body>
</html>