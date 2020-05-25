<?php 

include('includes/database.php');

$tag_list = findAll('tag',"cate_id=4");

$tag_id = isset($_GET['tag_id']) ? $_GET['tag_id'] : 13;

$art_id = isset($_GET['art_id']) ? $_GET['art_id'] : false;


$info = findOne("article","art_id = $art_id");


$sql ="";
$sql_count = "";
$tag_where = "";
if($tag_id){
    $sql = "SELECT * FROM {$pre_}article_data AS data where data.tag_id=$tag_id ORDER BY art_id DESC LIMIT 1";
    $sql_count = "SELECT count(*) AS c FROM {$pre_}article AS art LEFT JOIN {$pre_}article_data AS data ON art.art_id=data.art_id WHERE data.tag_id = $tag_id ";

  $tag_where = 1;
}else{
  $sql = "SELECT * FROM {$pre_}article ";

  $sql_count = "SELECT count(*) AS c FROM {$pre_}article";

  $tag_where = 1;
}
$res = sqlOne($sql);


//上一篇
$sql = "SELECT art_id FROM {$pre_}article WHERE cate_id>3 AND art_id<$art_id ORDER BY art_id DESC LIMIT 1";
$prev = sqlOne($sql);
//下一篇
$sql = "SELECT art_id FROM {$pre_}article WHERE cate_id<5 AND art_id > $art_id LIMIT 1";
$next = sqlOne($sql);


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
                         <li class="<?php echo $tag_id==$item['tag_id'] ? "on":"";?>"><a href="case_info.php?tag_id=<?php echo $item['tag_id'];?>&art_id=<?php echo $res['art_id'];?>"><?php echo $item['tag_name'];?></a></li>
                       
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

                <div class="com-nav-content">
                    <span><?php echo $info['art_content'];?></span>
                </div>
                <div class="com-info-page">
                    <?php if(!is_null($prev)){?>
                        <a href="case_info.php?tag_id=<?php echo $tag_id;?>&art_id=<?php echo $prev['art_id'];?>">上一篇</a>
                    <?php }else{ ?><a>没有上一篇了</a><?php }?>  
                    <?php if(!is_null($next)){?><a href="case_info.php?tag_id=<?php echo $tag_id;?>&art_id=<?php echo $next['art_id'];?>">下一篇</a>
                    <?php }else{ ?>
                        <a>没有下一篇了</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>


<?php include('footer.php');?>
</body>
</html>