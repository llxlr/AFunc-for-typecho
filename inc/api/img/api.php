<?php
/**
 * 随机图片方法
 * 作者：兔子
 */
function GetPageUrl(){
    // 判断是否https
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://": "http://";
    //组合url
    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $url;
}


$img_array = glob('images/*.{gif,jpg,png,jpeg,webp,bmp}', GLOB_BRACE);

if(count($img_array) == 0) die("没找到图片文件。<br>请先上传一些图片到 ".dirname(__FILE__)."/images/目录下<br>使用方式：<span style=\"color:red\">上传图片后</span>在需要用到随机图的地方填写该地址  <span style=\"color:red\">".GetPageUrl().'</span>');

header('Content-Type: image/png');

echo(file_get_contents($img_array[array_rand($img_array)]));

$img_array = glob('images/*.{gif,jpg,png,jpeg,webp,bmp}', GLOB_BRACE);


