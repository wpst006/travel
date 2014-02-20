<?php
session_start();

require_once("settings.php");
require_once("includes/db.php");
require_once("includes/autoID.php");
require_once("includes/loginFunction.php");
require_once("includes/shoppingcartFunction.php");
require_once("includes/messageHelper.php");

$objLogIn = new logIn;
$isLoggedIn = $objLogIn->isLoggedIn();
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Travel and Tour</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="default.css" rel="stylesheet" type="text/css" />
        <link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />
        <link href="css/chosen.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
        <link href="css/custom-style.css" rel="stylesheet" type="text/css" />
        <!-- Site JavaScript -->
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script src="js/chosen/chosen.jquery.min.js" type="text/javascript"></script>                                
        <script src="js/chosen/chosen.proto.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>  
    </head>
    <body>
        <div id="page">