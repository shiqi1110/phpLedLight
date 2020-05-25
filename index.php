<?php 

include("includes/database.php");

$nav_list = findAll('cate');

$tag_list = findAll('tag',"cate_id=2");

//查询热点产品应用
$sql = "SELECT * FROM {$pre_}article where cate_id=4 ORDER BY art_id LIMIT 6";
$hot_article = sqlAll($sql);

//查询热点新闻
$sql = "SELECT * FROM {$pre_}article where cate_id=3 ORDER BY art_id LIMIT 6";
$hot_news = sqlAll($sql);

//查询热点产品中心
$sql = "SELECT * FROM {$pre_}article where cate_id=2 ORDER BY art_id LIMIT 4";
$hot_product = sqlAll($sql);

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
<link rel='icon' href='assets/home/favicon.ico' type='image/x-ico' />
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

    <div  class="am-cf"></div>
    <div class="am-slider am-slider-default" data-am-flexslider="{playAfterPaused: 8000}">
        <ul class="am-slides">
            <li><img src="assets/home/images/index_banner.jpg" /></li>
            <li><img src="assets/home/images/index_banner.jpg" /></li>
            <li><img src="assets/home/images/index_banner.jpg" /></li>
        </ul>
    </div>

<div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >网页模板</a></div>
    <div class="index-nav">
        <div class="cms-g">

            <?php foreach($tag_list as $item){?>
            <div class="am-u-sm-6 am-u-md-6 am-u-lg-3">
                <div class="index-nav-item">
                    <div class="index-nav-img">
                        <img src="<?php echo $item['tag_img'];?>" />
                    </div>
                    <div class="index-nav-info">
                        <h1><?php echo $item['tag_name'];?></h1>
                        <h2><?php echo $item['tag_title'];?></h2>
                        <em class="font"><a href="product_info.php?tag_id=<?php echo $res=$item['tag_id'];?>&art_id=<?php echo $res=$item['tag_id'];?>">详细介绍&#xe72f;</a></em>
                    </div>
                </div>
            </div>
            <?php }?>

        </div>
    </div>


    <div class="index-content">
        <div class="cms-g">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-4">
                <div class="index-content-left">
                        <h1>产品中心</h1>
                        <div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
                        
                            <ul class="am-slides">
                            <?php foreach($hot_product as $item){?>
                                <li>
                                    <img src="<?php echo $item['art_img'];?>" />
                                    <strong><a href="#"><?php  echo $item['art_content'];?></a></strong>
                                     <em><a href="product_info.php?tag_id=<?php echo $item['art_id'];?>&art_id=<?php echo $item['art_id'];?>">详情介绍<i class="font">&#xe78d;</i></a></em>
                                </li>
                            <?php }?>
                            </ul>
                           
                        </div>
                         
                        
                    
                       
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-12 am-u-lg-4">
                <div class="index-content-center">
                    <h1>新闻动态<a href="new_list.php">MORE<i class="font">&#xe78d;</i></a></h1>
                      <?php foreach($hot_news as $item){?>
                    <ul>
                        <li><a href="new_info.php?art_id=<?php echo $item['art_id'];?>"><span><?php echo $item['art_title'];?></span><em><?php echo date("Y-m-d",$item['art_time']);?></em></a></li>
                    </ul>
                    <?php }?>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-12 am-u-lg-4">
                <div class="index-content-right">
                    <h1>产品应用<a href="case_list.php">MORE<i class="font">&#xe78d;</i></a></h1>
                    <img src="assets/home/images/index-content-right-01.jpg"/>
                     <?php foreach($hot_article as $item){?>
              
                   
                    <ul>
                        <li><a href="case_info.php?art_id=<?php echo $item['art_id'];?>"><?php echo $item['art_title'];?></a></li>
                    </ul>
                     <?php }?>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php');?>
   
</body>
</html>