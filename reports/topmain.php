<?php
//
// echo "<table class=header width=100% border=0 cellpadding=0 cellspacing=1>\n";
// echo "  <tr>";
//
// // display the logo in top left of each page. This will be $logo you setup in config.inc.php. //
// // It will also link you back to your index page. //
//
// if ($logo == "none") {
//     echo "    <td height=35 align=left></td>\n";
//
// } else {
//
//     echo "<td align=left><a href='../index.php'><img border=0 src='$logo'></a></td>\n";
// }
//
// // if db is out of date, report it here //
//
// if (($dbexists <> "1") || (@$my_dbversion <> $dbversion)) {
//     echo "    <td no class=notprint valign=middle align=left style='font-size:13;font-weight:bold;color:#AA0000'><p>***Your database is out of date.***<br />
//                                                                                 &nbsp;&nbsp;&nbsp;Upgrade it via the admin section.</p></td>\n";
// }
//
// // display a 'reset cookie' message if $use_client_tz = "yes" //
//
// if ($date_link == "none") {
//     if ($use_client_tz == "yes") {
//         echo "    <td class=notprint valign=middle align=right style='font-size:9px;'>
//       <p>If the times below appear to be an hour off, click <a href='../resetcookie.php' style='font-size:9px;'>here</a> to reset.<br />
//          If that doesn't work, restart your web browser and reset again.</p></td>\n";
//     }
//     echo "    <td colspan=2 scope=col align=right valign=middle><a style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>";
//
// } else {
//
//     if ($use_client_tz == "yes") {
//         echo "    <td class=notprint valign=middle align=right style='font-size:9px;'>
//       <p>If the times below appear to be an hour off, click <a href='../resetcookie.php' style='font-size:9px;'>here</a> to reset.<br />
//         If that doesn't work, restart your web browser and reset again.</p></td>\n";
//     }
//     echo "    <td colspan=2 scope=col align=right valign=middle><a href='$date_link' style='color:#000000;font-family:Tahoma;font-size:10pt;
//         text-decoration:none;'>";
// }
//
// // display today's date in top right of each page. This will link to $date_link you setup in config.inc.php. //
//
// $todaydate = date('F j, Y');
// echo "$todaydate&nbsp;&nbsp;</a></td></tr>\n";
// echo "</table>\n";
//
// // display the topbar //
//
// echo "<table class=topmain_row_color width=100% border=0 cellpadding=0 cellspacing=0>\n";
// echo "  <tr>\n";
// if (isset($_SESSION['valid_reports_user'])) {
//     $logged_in_user = $_SESSION['valid_reports_user'];
//     echo "    <td align=left valign=middle width=10 style='padding-left:12px;'><img src='../images/icons/user_suit.png' border='0'></td>\n";
//     echo "    <td align=left valign=middle style='color:#000000;font-family:Tahoma;font-size:10pt;padding-left:8px;'>logged in as:
// $logged_in_user</td>\n";
// }
// echo "    <td align=right valign=middle><img src='../images/icons/house.png' border='0'>&nbsp;&nbsp;</td>\n";
// echo "    <td align=right valign=middle width=10><a href='../index.php' style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>
//         Home&nbsp;&nbsp;</a></td>\n";
// echo "    <td align=right valign=middle width=23><img src='../images/icons/bricks.png' border='0'>&nbsp;&nbsp;</td>\n";
// echo "    <td align=right valign=middle width=10><a href='../login.php' style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>
//         Administration&nbsp;&nbsp;</a></td>\n";
// echo "    <td align=right valign=middle width=23><img src='../images/icons/report.png' border='0'>&nbsp;&nbsp;</td>\n";
//
// if ($use_reports_password == "yes") {
//     echo "    <td align=right valign=middle width=10><a href='../login_reports.php' style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>
//         Reports&nbsp;&nbsp;</a></td>\n";
// } elseif ($use_reports_password == "no") {
//     echo "    <td align=right valign=middle width=10><a href='index.php' style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>
//         Reports&nbsp;&nbsp;</a></td>\n";
// }
//
// echo "    <td align=right valign=middle width=23><img src='../images/icons/time.png' border='0'>&nbsp;&nbsp;</td>\n";
// echo "    <td align=right valign=middle width=10><a href='../punchclock/menu.php' style='color:#000000;font-family:Tahoma;font-size:10pt;
//         text-decoration:none;'>Punchclock&nbsp;&nbsp;</a></td>\n";
//
// if ((isset($_SESSION['valid_user'])) || (isset($_SESSION['valid_reports_user'])) || (isset($_SESSION['time_admin_valid_user']))) {
//     echo "    <td align=right valign=middle width=20><img src='../images/icons/arrow_rotate_clockwise.png' border='0'>&nbsp;</td>\n";
//     echo "    <td align=right valign=middle width=10><a href='../logout.php' style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>
//         Logout&nbsp;&nbsp;</a></td>\n";
// }
//
// echo "</tr></table>\n";

?>
<div class="main-panel">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">

      <a class="navbar-brand" href="index.php"></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <form class="navbar-form">
        <!-- <div class="input-group no-border">
          <input type="text" value="" class="form-control" placeholder="Search...">
          <button type="submit" class="btn btn-white btn-round btn-just-icon">
            <i class="material-icons">search</i>
            <div class="ripple-container"></div>
          </button>
        </div> -->
      </form>
      <ul class="navbar-nav">
      <!--date time-->
        <li class="nav-item">
        <span> <a class="nav-link" href="#" ><?php  $todaydate = date('F j, Y'); echo $todaydate; ?></a></span>
        </li>
        <!--print friendly-->
        <?php if (!isset($_GET['printer_friendly'])) { ?>
        <li class="nav-item"><a class="nav-link" href="timeclock.php?printer_friendly=true" >printer friendly page</a></li>
          <?php  }  ?>
          <!--notification-->
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
            <span class="notification"><?php  if(isset($count_notif)){echo $count_notif;}else{echo "0";} ?></span>
            <p class="d-lg-none d-md-block">
              notifications
            </p>
          </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
<?php
      if (($dbexists <> "1") || (@$my_dbversion <> $dbversion)) {
?>
            <a class="dropdown-item" href="#"><p>***Your database is out of date.***<br />Upgrade it via the admin section.</p></a>
<?php
        }
          if ($date_link == "none") {
            if ($use_client_tz == "yes") {
?>
                <a class="dropdown-item" href="#"><p>If the times below appear to be an hour off, click <a href='resetcookie.php' style='font-size:9px;'>here</a> to reset.<br />
                  If that doesn't work, restart your web browser and reset again.</p></a>
<?php
                }
              } else {
                if ($use_client_tz == "yes") {
?>
                <a class="dropdown-item" href="#"><p>If the times below appear to be an hour off, click <a href='resetcookie.php' style='font-size:9px;'>here</a> to reset.<br />
                  If that doesn't work, restart your web browser and reset again.</p></a>
                  <a href='<?php echo $date_link; ?>' style='color:#000000;font-family:Tahoma;font-size:10pt;text-decoration:none;'>
                  </a>
<?php
                  }

                }
?>
</div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              Account
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <?php
            if (isset($_SESSION['valid_user'])) {
                $logged_in_user = $_SESSION['valid_user'];?>

             <a class="dropdown-item" href="#">logged in as: <?php echo $logged_in_user ?></a>
               <div class="dropdown-divider"></div>
            <?php
            } else if (isset($_SESSION['time_admin_valid_user'])) {
                $logged_in_user = $_SESSION['time_admin_valid_user'];

             ?>
              <a class="dropdown-item" href="#">logged in as: <?php echo $logged_in_user ?></a>
                <div class="dropdown-divider"></div>
            <?php
            } else if (isset($_SESSION['valid_reports_user'])) {
                $logged_in_user = $_SESSION['valid_reports_user'];
                ?>
                 <a class="dropdown-item" href="#">logged in as: <?php echo $logged_in_user ?></a>
                   <div class="dropdown-divider"></div>
            <?php
            }
            ?>


            <a class="dropdown-item" href="../login.php">Administration</a>
            <?php if ($use_reports_password == "yes") { ?> <a class="dropdown-item" href="login_reports.php">Reports</a>
          <?php }elseif($use_reports_password == "no"){ ?> <a class="dropdown-item" href="./index.php">Reports</a><?php } ?>


            <a class="dropdown-item" href="../punchclock/menu.php">Punsh Clock</a>
            <?php if ((isset($_SESSION['valid_user'])) || (isset($_SESSION['valid_reports_user'])) || (isset($_SESSION['time_admin_valid_user']))) { ?>
            <a class="dropdown-item" href="logout.php">Log out</a>
          <?php } ?>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
