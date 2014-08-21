<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>boncugu</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/justifiedGallery.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/jquery.dataTables.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery.color.js"></script>
    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>public/js/application.js"></script>
    <script src="<?php echo URL; ?>public/js/justifiedGallery.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
    <script src="<?php echo URL; ?>public/js/imagelightbox.js"></script>
</head>
<body>
<!-- header -->
<div style="height: 40px">
    <div id="header-bar">
        <a href="<?php echo URL; ?>">
            <img src="<?php echo URL; ?>public/img/logo-trans.png"  style="height: 40px"/>
        </a>
        <?php
        if(isset($brand)){
            echo '&nbsp;> ';
            echo '<a href="';
            echo URL;
            echo 'brand/index/';
            echo $brand;
            echo '">';
            echo $brand;
            echo '</a>';
        }
        if(isset($model_name)){
            echo ' > ';
            echo '<a href="';
            echo URL;
            echo 'model/index/';
            echo $brand .'/' .$model;
            echo '">';
            echo $model_name;
            echo '</a>';
        }
        ?>
        <?php 
        if(isset($model)){
        $action = URL .'model/search/' .$brand .'/' .$model; ?>
        <form id="photo-search" method="post" action="<?php echo $action; ?>" onSubmit="chgact()">
            <div id="search">
                <input id="q_cam" name="q_cam" type="text" placeholder="Search..." required>
                <input type="hidden" id="php_action" value="<?php echo $action; ?>">
            </div>
        </form>
        <?php } ?>
    </div>
</div>
