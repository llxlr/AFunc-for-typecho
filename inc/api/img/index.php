<?php

// 文件夹地址
$DIR = @$_GET['dir'] ? $_GET['dir'] : '';
// 文件夹名称
$NAME = @$_GET['name'] ? $_GET['name'] : '';

$ROOT = $_SERVER["DOCUMENT_ROOT"];

(substr($ROOT,-1) == '/') ? $ROOT : $ROOT = $ROOT.'/';

// 判断必填参数
if(!empty($NAME)){
    
    // 判断选填参数
    if(empty($DIR)){
        
        // 创建目录
        AS_MKDIR($NAME);
        
        // 复制文件
        AS_FILE($NAME.'/');
        
        echo '激活成功！<br>
              使用方式：<br>
              1、上传图片到'.$ROOT.'usr/api/'.$NAME.'/images/目录下<br>
              2、<span style=\'color:red\'>上传图片后</span>上传图片后在需要用到随机图的地方填写该地址 <span style=\'color:red\'><a href='.GetPageUrl().'/usr/api/'.$NAME.'/>'.GetPageUrl().'/usr/api/'.$NAME.'/</a></span>
              
              ';
              
            //   var_dump($_SERVER);
        
    }else{
        
        // 创建目录
        AS_MKDIR($NAME,$DIR.'/');
        
        // 复制文件
        AS_FILE($NAME.'/',$DIR.'/');
        
        echo '激活成功！';
    }
}

// 创建目录
function AS_MKDIR($NAME, $DIR='usr/api/'){
    
    $ROOT = $_SERVER["DOCUMENT_ROOT"];

    (substr($ROOT,-1) == '/') ? $ROOT : $ROOT = $ROOT.'/';
    
    $mkdir = iconv("UTF-8", "GBK",$NAME);
    
    $mkdir = $ROOT.$DIR.$mkdir;
    
    if(!file_exists($mkdir)){
        
        mkdir ($mkdir,0755,true);
        mkdir ($mkdir.'/images',0755,true);
    }
}

// 复制文件
function AS_FILE($NAME, $DIR='usr/api/'){
    
    $ROOT = $_SERVER["DOCUMENT_ROOT"];

    (substr($ROOT,-1) == '/') ? $ROOT : $ROOT = $ROOT.'/';
    
    if(!file_exists('api.php')) return false;
     
    return copy('api.php', $ROOT.$DIR.$NAME.'index.php');
}

// 获取路径
function GetPageUrl(){
    // 判断是否https
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://": "http://";
    //组合url
    $url = $protocol . $_SERVER['HTTP_HOST'];
    return $url;
}







