﻿
<?php 

include('includes/database.php');


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

    <style type="text/css">
        html, body { margin: 0; padding: 0; }
        .iw_poi_title { color: #CC5522; font-size: 14px; font-weight: bold; overflow: hidden; padding-right: 13px; white-space: nowrap; }
        .iw_poi_content { font: 12px arial,sans-serif; overflow: visible; padding-top: 4px; white-space: -moz-pre-wrap; word-wrap: break-word; }
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>

</head>
<body>
    <?php include('header.php');?>

    <div class="com-banner">
        <img src="assets/home/images/index_banner.jpg" />
    </div>
    <div class="com-container">
        <div class="cms-g">
            <div class="contact">
                <h1>
                    <em>CONTACT 联系我们</em>
                    <span>
                        <a href="#">联系我们</a>
                        <a href="#">在线客服</a>
                    </span>
                </h1>
                <div class="am-u-md-12 am-u-md-5 am-u-lg-5">
                    <div class="contact-left">
                        <h1>
                            <strong class="f-toe">大冶市云阿拉丁科技有限公司</strong>
                            <span class="f-toe">Daye Aladdin Technology Co., Ltd.</span>
                        </h1>
                        <ul>
                            <li><span>业务质询一：</span><a href="#">467843489</a></li>
                            <li><span>业务质询二：</span><a href="#">467843489</a></li>
                            <li><span>咨询电话：</span>0714-8878313</li>
                            <li><span>公司传真：</span>0714-8878313</li>
                            <li><span>地址：</span>大冶大道116金惠小区好太太总部2楼</li>
                            <li><span>邮编：</span>435100</li>
                            <li><span>网址：</span><a href="http://www.cssmoban.com">http://www.cssmoban.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-7 am-u-lg-7">
                    <div class="contact-right">
                        <div style="width:100%;height:400px;border:#ccc solid 1px;" id="dituContent"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    ﻿<?php include('footer.php');?>


    <script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }

    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(114.973751,30.107215);//定义一个中心点坐标
        map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }

    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }

    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
	map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }

    //标注点数组
    var markerArr = [{title:"好太太2楼总部",content:"金惠小区进去好太太2楼总部",point:"114.9738|30.107668",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
		 ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
			var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
			var iw = createInfoWindow(i);
			var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
			marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });

			(function(){
				var index = i;
				var _iw = createInfoWindow(i);
				var _marker = marker;
				_marker.addEventListener("click",function(){
				    this.openInfoWindow(_iw);
			    });
			    _iw.addEventListener("open",function(){
				    _marker.getLabel().hide();
			    })
			    _iw.addEventListener("close",function(){
				    _marker.getLabel().show();
			    })
				label.addEventListener("click",function(){
				    _marker.openInfoWindow(_iw);
			    })
				if(!!json.isOpen){
					label.hide();
					_marker.openInfoWindow(_iw);
				}
			})()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }

    initMap();//创建和初始化地图
    </script>

</body>
</html>