<?php
function get_rand_str($length = 4){
    $chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = str_shuffle($chars);
    return substr($str,0,$length);
}

$width = 150;
$height = 50;

//生成一个指定宽高度大小的图片
$img = imagecreatetruecolor($width,$height);

//背景颜色
$background_color = imagecolorallocate($img,45,67,77);

//文字颜色
$text_color = imagecolorallocate($img,120,165,34);

//在图片上面去画一个区域
imagefilledrectangle($img,0,0,$width,$height,$background_color);

//获取一个随机的字符
$str = get_rand_str();

//将随机数写到图片上面
imagestring($img,5,55,17,$str,$text_color);

//为了防止别人恶意刷验证码可以在图片上面打点
for ($i=1; $i <=30 ; $i++) { 
    $x = mt_rand(0,$width);
    $y = mt_rand(0,$height);
    imagesetpixel($img,$x,$y,imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255)));
}

//开启session会话
session_start();

//注册会话变量
$_SESSION['imgcode'] = $str;

//输出图片头信息
header("Content-Type:image/png");

//输出图片
imagepng($img);

//当图片成功输出之后就释放它
imagedestroy($img);

?>