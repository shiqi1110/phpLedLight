<?php 

include('includes/database.php');
$tag_list = findAll('tag',"cate_id=2");

$tag_id = isset($_GET['tag_id']) ? $_GET['tag_id'] : 6;

$art_id = isset($_GET['art_id']) ? $_GET['art_id'] : false;


$info = findOne("article","art_id = $art_id");

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

    <script src="js/easyzoom.js"></script>
    <div class="com-banner">
        <img src="assets/home/images/index_banner.jpg" />
    </div>
    <div class="com-container">
        <div class="cms-g">
            <div class="am-hide-sm-only am-u-md-3 am-u-lg-3">
                <div class="com-nav-left">
                    <h1><em>产品中心</em><i>PRODUCT</i></h1>
                      <?php foreach($tag_list as $item){?>
                        <ul >
                            <li class="<?php echo $tag_id==$item['tag_id'] ? "on":"";?>"><a href="product_info.php?tag_id=<?php echo $item['tag_id'];?>&art_id=<?php echo $item['tag_id'];?>"><?php echo $item['tag_name'];?></a></li>
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
                    <ol class="com-position am-show-md-up">
                        <li><a href="#">首页</a></li>
                        <li><a href="#">产品中心</a></li>

                        <li><a href="#">
                         <?php echo $info['art_title'];?>
                        </a></li>

                    </ol>
                </div>
                <div class="product-info">
                    <div class="am-u-sm-12 am-u-md-6">
                           <div data-am-widget="slider" class="am-slider am-slider-default" data-am-slider='{&quot;animation&quot;:&quot;slide&quot;,&quot;controlNav&quot;:&quot;thumbnails&quot;}'>
                                <ul class="am-slides">
                                    <li data-thumb="http://s.amazeui.org/media/i/demos/bing-1.jpg">
                                        <img src="http://s.amazeui.org/media/i/demos/bing-1.jpg">
                                    </li>
                                    <li data-thumb="http://s.amazeui.org/media/i/demos/bing-2.jpg">
                                        <img src="http://s.amazeui.org/media/i/demos/bing-2.jpg">
                                    </li>
                                    <li data-thumb="http://s.amazeui.org/media/i/demos/bing-3.jpg">
                                        <img src="http://s.amazeui.org/media/i/demos/bing-3.jpg">
                                    </li>
                                    <li data-thumb="http://s.amazeui.org/media/i/demos/bing-4.jpg">
                                        <img src="http://s.amazeui.org/media/i/demos/bing-4.jpg">
                                    </li>
                                </ul>
                            </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="prodct-info-canshu">
                            <ul>
                             <?php echo $info['art_message'];?>
                            </ul>
                        </div>
                    </div>
                    <div class="am-u-sm-12  am-u-md-12">
                        <div class="product_tabs">
                            <div class="am-tabs" data-am-tabs>
                                <ul class="am-tabs-nav am-nav am-nav-tabs">
                                    <li class="am-active"><a href="#tab1">详细说明1</a></li>
                                    <li><a href="#tab2">详细说明2</a></li>
                                    <li><a href="#tab3">详细说明3</a></li>
                                    <li><a href="#tab4">详细说明4</a></li>
                                </ul>
                                <div class="am-tabs-bd">
                                    <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                                      <?php echo $info['art_content'];?>
                                    </div>
                                    <div class="am-tab-panel am-fade" id="tab2">
                                       <?php echo $info['art_content2'];?>
                                    </div>
                                    <div class="am-tab-panel am-fade" id="tab3">
                                        详细说明3
                                    </div>
                                    <div class="am-tab-panel am-fade" id="tab4">
                                        详细说明4
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!--     <div id="doc-oc-demo1" class="am-offcanvas">
        <div class="am-offcanvas-bar">
            <div class="am-offcanvas-content com-nav-left com-nav-left1">
                <ul>
                    <li class="on"><span><a href="#">LED T8灯管</a></span></li>
                    <li><span><a href="#">LED射灯</a></span></li>
                    <li><span><a href="#">LED软光灯</a></span></li>
                    <li><span><a href="#">LED泛光灯</a></span></li>
                    <li><span><a href="#">LED洗墙灯</a></span></li>
                </ul>
            </div>
        </div>
    </div> -->
   <?php include('footer.php');?>
</body>
</html>