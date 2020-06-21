<?php
/**
 * Punchclock programs' header.
 */

require_once 'config.inc.php';

// Arguments
global $PAGE_TITLE, $PAGE_META, $PAGE_STYLE, $PAGE_SCRIPT, $PAGE_BODY_ID, $PAGE_CONTENT_HEADER;

// Default values
$PAGE_TITLE = isset($PAGE_TITLE) ? $PAGE_TITLE : $title;
$PAGE_META = isset($PAGE_META) ? $PAGE_META : "";
$PAGE_STYLE = isset($PAGE_STYLE) ? $PAGE_STYLE : "";
$PAGE_SCRIPT = isset($PAGE_SCRIPT) ? $PAGE_SCRIPT : "";
$PAGE_BODY_ID = isset($PAGE_BODY_ID) ? $PAGE_BODY_ID : "";
$PAGE_CONTENT_HEADER = isset($PAGE_CONTENT_HEADER) ? $PAGE_CONTENT_HEADER : "";

////////////////////////////////////////

?>
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../assets/img/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php echo $PAGE_TITLE; ?></title>
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<!-- CSS Files -->
<link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
</head>
<body>
  <?php if (strlen($PAGE_BODY_ID) > 0)
      echo " id=\"$PAGE_BODY_ID\""; ?>>
<div class="wrapper">

  
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
    <title><?php //echo $PAGE_TITLE; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php //if (strlen($PAGE_META) > 0)
        //echo "$PAGE_META\n"; ?>
    <link rel="icon" href="/favicon.ico"/>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="<?php //echo $TIMECLOCK_URL; ?>/css/default.css"/>
    <link rel="stylesheet" type="text/css" href="css/punchclock.css"/>
    <style type="text/css">
        tr.odd {
            background-color: <?php //echo $color1; ?>;
        }

        tr.even {
            background-color: <?php //echo $color2; ?>;
        }
    </style>
    <?php //if (strlen($PAGE_STYLE) > 0)
        //echo "$PAGE_STYLE\n"; ?>
    <script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="scripts/resize_window.js"></script>
    <?php //if (strlen($PAGE_SCRIPT) > 0)
        //echo "$PAGE_SCRIPT\n"; ?>
</head>
<body<?php //if (strlen($PAGE_BODY_ID) > 0)
    //echo " id=\"$PAGE_BODY_ID\""; ?>>
<div class="page">

    <?php //include 'header_timeclock.php'; ?>

    <?php //if (strlen($PAGE_CONTENT_HEADER) > 0)
        //echo "$PAGE_CONTENT_HEADER\n"; ?>
    <div class="content"> -->
