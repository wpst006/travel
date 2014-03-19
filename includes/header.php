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
        <link href="css/flexslider.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Site JavaScript -->
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script src="js/chosen/chosen.jquery.min.js" type="text/javascript"></script>                                
        <script src="js/chosen/chosen.proto.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>  
        <script src="js/jquery.flexslider.js" type="text/javascript"></script> 
        <script src="js/moment-2.4.0.js" type="text/javascript"></script> 
        <script src="js/bootstrap-datetimepicker.js" type="text/javascript"></script>         
    </head>
    <body>
        <div id="page">
            <?php include ('includes/sidebar.php'); ?>
            <div id="content">
                <?php include ('includes/banner.php'); ?>

                <div id="content-inner">

                    <?php if (isset($pageTitle)) { ?>
                        <div class="my-page-heading"><?php echo $pageTitle; ?></div>
                    <?php } ?>

                    <?php
                    $message = messageHelper::getMessage();

                    if (isset($message)) {
                        echo $message;
                        messageHelper::clearMessage();
                    }
                    ?>