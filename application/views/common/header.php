<?php
/**
 * Author:LNC
 * Description: 后台头部文件
 * Date: 2016/4/21 0021
 * Time: 下午 8:00
 */
$base_css_url = $this->config->item('css_url');
$base_js_url = $this->config->item('js_url');
$base_img_url = $this->config->item('img_url');
$static_url = $this->config->item('static_url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>闪修哥后台管理系统</title>
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo $base_css_url?>/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $base_css_url?>/font-awesome.min.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace-fonts.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace.min.css" />

    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace-skins.min.css" />
    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace-rtl.min.css" />

    <link rel="stylesheet" href="<?php echo $base_css_url?>/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?php echo $base_js_url?>/ace-extra.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <script src="<?php  echo $base_js_url  ?>/html5shiv.js"></script>
    <script src="<?php echo $base_js_url?>/respond.min.js"></script>
    <![endif]-->
</head>

<body class="no-skin">