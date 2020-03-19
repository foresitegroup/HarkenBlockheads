<?php include_once "../inc/dbconfig.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Harken Blockheads Administration<?php if ($PageTitle != "") echo " | " . $PageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Foresite Group">

    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800|Work+Sans:900" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../inc/main.css?<?php echo filemtime('../inc/main.css'); ?>">
    <link rel="stylesheet" href="inc/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="inc/jquery.timepicker.css" type="text/css">
    <link rel="stylesheet" href="inc/admin.css?<?php echo filemtime('inc/admin.css'); ?>">

    <script type="text/javascript" src="../inc/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="inc/jquery-ui.min.js"></script>
    <script type="text/javascript" src="inc/jquery.timepicker.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("a[href^='http'], a[href$='.pdf']").not("[href*='" + window.location.host + "']").attr('target','_blank');

        $(".startdate, .enddate").datepicker();
        $(".starttime, .endtime").timepicker({ 'scrollDefault': 'now' });

        $("#mediamanager").dialog({ autoOpen: false, modal: true, width: $(window).width() > 1000 ? 1000 : '90%' });
        $("#image").on("click", function() {
          $("#mediamanager").dialog("open");
        });
        
        $("#tabs").tabs();
      });
    </script>
  </head>
  <body>
    
    <div class="menu-spacer sticky"></div>

    <div class="menu sticky">
      <div class="site-width">
        <div class="menu-logo">
          <a href="."><img src="../images/logo-menu.png" alt=""></a>
        </div>
        
        <?php if ($PageTitle != "Login") { ?>
        <ul>
          <li><a href="join.php">SIGN UPS</a></li>
          <li><a href="events.php">EVENTS</a></li>
        </ul>
        <?php } ?>
      </div>
    </div>