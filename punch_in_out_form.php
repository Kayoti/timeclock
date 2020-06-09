<?php
session_start();

include 'config.inc.php';
include 'header.php';

if (!isset($_GET['printer_friendly'])) {

    if (isset($_SESSION['valid_user'])) {
        $set_logout = "1";
    }

    include 'sidenav.php';
    include 'topmain.php';

}


$current_page = "punch_in_out_form.php";

if (!isset($_GET['printer_friendly'])) {
    echo "    <td align=left class=right_main scope=col>\n";
    echo "      <table width=100% height=100% border=0 cellpadding=5 cellspacing=1>\n";
    echo "        <tr class=right_main_text>\n";
    echo "          <td valign=top>\n";
}

// code to allow sorting by Name, In/Out, Date, Notes //

if ($show_display_name == "yes") {
    if (!isset($_GET['sortcolumn'])) {
        $sortcolumn = "displayname";
    } else {
        $sortcolumn = $_GET['sortcolumn'];
    }

} else {

    if (!isset($_GET['sortcolumn'])) {
        $sortcolumn = "fullname";
    } else {
        $sortcolumn = $_GET['sortcolumn'];
    }

}

if (!isset($_GET['sortdirection'])) {
    $sortdirection = "asc";
} else {
    $sortdirection = $_GET['sortdirection'];
}

if ($sortdirection == "asc") {
    $sortnewdirection = "desc";
} else {
    $sortnewdirection = "asc";
}

// determine what users, office, and/or group will be displayed on main page //

if (($display_current_users == "yes") && ($display_office == "all") && ($display_group == "all")) {
    $current_users_date = strtotime(date($datefmt));
    $calc = 86400;
    $a = $current_users_date + $calc - @$tzo;
    $b = $current_users_date - @$tzo;

    $query = "select " . $db_prefix . "info.*, " . $db_prefix . "employees.*, " . $db_prefix . "punchlist.*
              from " . $db_prefix . "info, " . $db_prefix . "employees, " . $db_prefix . "punchlist
              where " . $db_prefix . "info.timestamp = " . $db_prefix . "employees.tstamp and " . $db_prefix . "info.fullname = " . $db_prefix . "employees.empfullname
              and " . $db_prefix . "info.`inout` = " . $db_prefix . "punchlist.punchitems and ((" . $db_prefix . "info.timestamp < '" . $a . "') and
              (" . $db_prefix . "info.timestamp >= '" . $b . "')) and " . $db_prefix . "employees.disabled <> '1' and " . $db_prefix . "employees.empfullname <> 'admin'
              order by `$sortcolumn` $sortdirection";
    $result = mysqli_query($db,$query);
} elseif (($display_current_users == "yes") && ($display_office != "all") && ($display_group == "all")) {

    $current_users_date = strtotime(date($datefmt));
    $calc = 86400;
    $a = $current_users_date + $calc - @$tzo;
    $b = $current_users_date - @$tzo;

    $query = "select " . $db_prefix . "info.*, " . $db_prefix . "employees.*, " . $db_prefix . "punchlist.*
              from " . $db_prefix . "info, " . $db_prefix . "employees, " . $db_prefix . "punchlist
              where " . $db_prefix . "info.timestamp = " . $db_prefix . "employees.tstamp and " . $db_prefix . "info.fullname = " . $db_prefix . "employees.empfullname
              and " . $db_prefix . "info.`inout` = " . $db_prefix . "punchlist.punchitems and " . $db_prefix . "employees.office = '" . $display_office . "'
              and ((" . $db_prefix . "info.timestamp < '" . $a . "') and (" . $db_prefix . "info.timestamp >= '" . $b . "'))
              and " . $db_prefix . "employees.disabled <> '1' and " . $db_prefix . "employees.empfullname <> 'admin'
              order by `$sortcolumn` $sortdirection";
    $result = mysqli_query($db,$query);
} elseif (($display_current_users == "yes") && ($display_office == "all") && ($display_group != "all")) {

    $current_users_date = strtotime(date($datefmt));
    $calc = 86400;
    $a = $current_users_date + $calc - @$tzo;
    $b = $current_users_date - @$tzo;

    $query = "select " . $db_prefix . "info.*, " . $db_prefix . "employees.*, " . $db_prefix . "punchlist.*
              from " . $db_prefix . "info, " . $db_prefix . "employees, " . $db_prefix . "punchlist
              where " . $db_prefix . "info.timestamp = " . $db_prefix . "employees.tstamp and " . $db_prefix . "info.fullname = " . $db_prefix . "employees.empfullname
              and " . $db_prefix . "info.`inout` = " . $db_prefix . "punchlist.punchitems and " . $db_prefix . "employees.groups = '" . $display_group . "'
              and ((" . $db_prefix . "info.timestamp < '" . $a . "') and (" . $db_prefix . "info.timestamp >= '" . $b . "'))
              and " . $db_prefix . "employees.disabled <> '1' and " . $db_prefix . "employees.empfullname <> 'admin'
              order by `$sortcolumn` $sortdirection";
    $result = mysqli_query($db,$query);
} elseif (($display_current_users == "yes") && ($display_office != "all") && ($display_group != "all")) {

    $current_users_date = strtotime(date($datefmt));
    $calc = 86400;
    $a = $current_users_date + $calc - @$tzo;
    $b = $current_users_date - @$tzo;

    $query = "select " . $db_prefix . "info.*, " . $db_prefix . "employees.*, " . $db_prefix . "punchlist.*
              from " . $db_prefix . "info, " . $db_prefix . "employees, " . $db_prefix . "punchlist
              where " . $db_prefix . "info.timestamp = " . $db_prefix . "employees.tstamp and " . $db_prefix . "info.fullname = " . $db_prefix . "employees.empfullname
              and " . $db_prefix . "info.`inout` = " . $db_prefix . "punchlist.punchitems and " . $db_prefix . "employees.office = '" . $display_office . "'
              and " . $db_prefix . "employees.groups = '" . $display_group . "' and ((" . $db_prefix . "info.timestamp < '" . $a . "')
              and (" . $db_prefix . "info.timestamp >= '" . $b . "')) and " . $db_prefix . "employees.disabled <> '1'
              and " . $db_prefix . "employees.empfullname <> 'admin'
              order by `$sortcolumn` $sortdirection";
    $result = mysqli_query($db,$query);
} elseif (($display_current_users == "no") && ($display_office == "all") && ($display_group == "all")) {

    $query = "select " . $db_prefix . "info.*, " . $db_prefix . "employees.*, " . $db_prefix . "punchlist.*
              from " . $db_prefix . "info, " . $db_prefix . "employees, " . $db_prefix . "punchlist
              where " . $db_prefix . "info.timestamp = " . $db_prefix . "employees.tstamp and " . $db_prefix . "info.fullname = " . $db_prefix . "employees.empfullname
              and " . $db_prefix . "info.`inout` = " . $db_prefix . "punchlist.punchitems and " . $db_prefix . "employees.disabled <> '1'
              and " . $db_prefix . "employees.empfullname <> 'admin'
              order by `$sortcolumn` $sortdirection";
    $result = mysqli_query($db,$query);
} elseif (($display_current_users == "no") && ($display_office != "all") && ($display_group == "all")) {

    $query = "select " . $db_prefix . "info.*, " . $db_prefix . "employees.*, " . $db_prefix . "punchlist.*
              from " . $db_prefix . "info, " . $db_prefix . "employees, " . $db_prefix . "punchlist
              where " . $db_prefix . "info.timestamp = " . $db_prefix . "employees.tstamp and " . $db_prefix . "info.fullname = " . $db_prefix . "employees.empfullname
              and " . $db_prefix . "info.`inout` = " . $db_prefix . "punchlist.punchitems and " . $db_prefix . "employees.office = '" . $display_office . "'
              and " . $db_prefix . "employees.disabled <> '1' and " . $db_prefix . "employees.empfullname <> 'admin'
              order by `$sortcolumn` $sortdirection";
    $result = mysqli_query($db,$query);
} elseif (($display_current_users == "no") && ($display_office == "all") && ($display_group != "all")) {

    $query = "select " . $db_prefix . "info.*, " . $db_prefix . "employees.*, " . $db_prefix . "punchlist.*
              from " . $db_prefix . "info, " . $db_prefix . "employees, " . $db_prefix . "punchlist
              where " . $db_prefix . "info.timestamp = " . $db_prefix . "employees.tstamp and " . $db_prefix . "info.fullname = " . $db_prefix . "employees.empfullname
              and " . $db_prefix . "info.`inout` = " . $db_prefix . "punchlist.punchitems and " . $db_prefix . "employees.groups = '" . $display_group . "'
              and " . $db_prefix . "employees.disabled <> '1' and " . $db_prefix . "employees.empfullname <> 'admin'
              order by `$sortcolumn` $sortdirection";
    $result = mysqli_query($db,$query);
} elseif (($display_current_users == "no") && ($display_office != "all") && ($display_group != "all")) {

    $query = "select " . $db_prefix . "info.*, " . $db_prefix . "employees.*, " . $db_prefix . "punchlist.*
              from " . $db_prefix . "info, " . $db_prefix . "employees, " . $db_prefix . "punchlist
              where " . $db_prefix . "info.timestamp = " . $db_prefix . "employees.tstamp and " . $db_prefix . "info.fullname = " . $db_prefix . "employees.empfullname
              and " . $db_prefix . "info.`inout` = " . $db_prefix . "punchlist.punchitems and " . $db_prefix . "employees.office = '" . $display_office . "'
              and " . $db_prefix . "employees.groups = '" . $display_group . "' and " . $db_prefix . "employees.disabled <> '1'
              and " . $db_prefix . "employees.empfullname <> 'admin'
              order by `$sortcolumn` $sortdirection";
    $result = mysqli_query($db,$query);
}

$time = time();
$tclock_hour = gmdate('H', $time);
$tclock_min = gmdate('i', $time);
$tclock_sec = gmdate('s', $time);
$tclock_month = gmdate('m', $time);
$tclock_day = gmdate('d', $time);
$tclock_year = gmdate('Y', $time);
$tclock_stamp = mktime($tclock_hour, $tclock_min, $tclock_sec, $tclock_month, $tclock_day, $tclock_year);

$tclock_stamp = $tclock_stamp + @$tzo;
$tclock_time = date($timefmt, $tclock_stamp);
$tclock_date = date($datefmt, $tclock_stamp);
$report_name = "Current Status Report";

echo "            <table width=100% align=center class=misc_items border=0 cellpadding=3 cellspacing=0>\n";

if (!isset($_GET['printer_friendly'])) {
    echo "              <tr class=display_hide>\n";
} else {
    echo "              <tr>\n";
}

echo "                <td nowrap style='font-size:9px;color:#000000;padding-left:10px;'>$report_name&nbsp;&nbsp;---->&nbsp;&nbsp;As of: $tclock_time,
                    $tclock_date</td></tr>\n";
echo "            </table>\n";



// display form to submit signin/signout information //

echo "        <form name='timeclock' action='$self' method='post'>\n";

if ($links == "none") {
    echo "        <tr><td height=7></td></tr>\n";
} else {
    echo "        <tr><td height=20></td></tr>\n";
}

echo "        <tr><td class=title_underline height=4 align=left valign=middle style='padding-left:10px;'>Please sign in below:</td></tr>\n";
echo "        <tr><td height=7></td></tr>\n";
echo "        <tr><td height=4 align=left valign=middle class=misc_items>Name:</td></tr>\n";
echo "        <tr><td height=4 align=left valign=middle class=misc_items>\n";

// query to populate dropdown with employee names //

if ($show_display_name == "yes") {

    $query = "select displayname from " . $db_prefix . "employees where disabled <> '1'  and empfullname <> 'admin' order by displayname";
    $emp_name_result = mysqli_query($db,$query);
    echo "              <select name='left_displayname' tabindex=1>\n";
    echo "              <option value =''>...</option>\n";

    while ($row = mysqli_fetch_array($emp_name_result)) {

        $abc = stripslashes("" . $row['displayname'] . "");

        if ((isset($_COOKIE['remember_me'])) && (stripslashes($_COOKIE['remember_me']) == $abc)) {
            echo "              <option selected>$abc</option>\n";
        } else {
            echo "              <option>$abc</option>\n";
        }

    }

    echo "              </select></td></tr>\n";
    mysqli_free_result($emp_name_result);
    echo "        <tr><td height=7></td></tr>\n";

} else {

    $query = "select empfullname from " . $db_prefix . "employees where disabled <> '1'  and empfullname <> 'admin' order by empfullname";
    $emp_name_result = mysqli_query($db,$query);
    echo "              <select name='left_fullname' tabindex=1>\n";
    echo "              <option value =''>...</option>\n";

    while ($row = mysqli_fetch_array($emp_name_result)) {

        $def = stripslashes("" . $row['empfullname'] . "");
        if ((isset($_COOKIE['remember_me'])) && (stripslashes($_COOKIE['remember_me']) == $def)) {
            echo "              <option selected>$def</option>\n";
        } else {
            echo "              <option>$def</option>\n";
        }

    }

    echo "              </select></td></tr>\n";
    mysqli_free_result($emp_name_result);
    echo "        <tr><td height=7></td></tr>\n";
}

// determine whether to use encrypted passwords or not //

if ($use_passwd == "yes") {
    echo "        <tr><td height=4 align=left valign=middle class=misc_items>Password:</td></tr>\n";
    echo "        <tr><td height=4 align=left valign=middle class=misc_items>";
    echo "<input type='password' name='employee_passwd' maxlength='25' size='17' tabindex=2></td></tr>\n";
    echo "        <tr><td height=7></td></tr>\n";
}

echo "        <tr><td height=4 align=left valign=middle class=misc_items>In/Out:</td></tr>\n";
echo "        <tr><td height=4 align=left valign=middle class=misc_items>\n";

// query to populate dropdown with punchlist items //

$query = "select punchitems from " . $db_prefix . "punchlist";
$punchlist_result = mysqli_query($db,$query);

echo "              <select name='left_inout' tabindex=3>\n";
echo "              <option value =''>...</option>\n";

while ($row = mysqli_fetch_array($punchlist_result)) {
    echo "              <option>" . $row['punchitems'] . "</option>\n";
}

echo "              </select></td></tr>\n";
mysqli_free_result($punchlist_result);

echo "        <tr><td height=7></td></tr>\n";
echo "        <tr><td height=4 align=left valign=middle class=misc_items>Notes:</td></tr>\n";
echo "        <tr><td height=4 align=left valign=middle class=misc_items>";
echo "<input type='text' name='left_notes' maxlength='250' size='17' tabindex=4></td></tr>\n";

if (!isset($_COOKIE['remember_me'])) {
    echo "        <tr><td width=100%><table width=100% border=0 cellpadding=0 cellspacing=0>
                  <tr><td nowrap height=4 align=left valign=middle class=misc_items width=10%>Remember&nbsp;Me?</td><td width=90% align=left
                    class=misc_items style='padding-left:0px;padding-right:0px;' tabindex=5><input type='checkbox' name='remember_me' value='1'></td></tr>
                    </table></td><tr>\n";
} elseif (isset($_COOKIE['remember_me'])) {
    echo "        <tr><td width=100%><table width=100% border=0 cellpadding=0 cellspacing=0>
                  <tr><td nowrap height=4 align=left valign=middle class=misc_items width=10%>Reset&nbsp;Cookie?</td><td width=90% align=left
                    class=misc_items style='padding-left:0px;padding-right:0px;' tabindex=5><input type='checkbox' name='reset_cookie' value='1'></td></tr>
                    </table></td><tr>\n";
}

echo "        <tr><td height=7></td></tr>\n";
echo "        <tr><td height=4 align=left valign=middle class=misc_items><input type='submit' name='submit_button' value='Submit' align='center'
                tabindex=6></td></tr></form>\n";


 ?>

 <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
        <form class="form" method="" action="">
          <div class="card card-login card-hidden">
            <div class="card-header card-header-primary text-center">
              <h4 class="card-title">Please Sign-In Below</h4>
              <!-- <div class="social-line">
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-facebook-square"></i>
                </a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-twitter"></i>
                </a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-google-plus"></i>
                </a>
              </div> -->
            </div>
            <div class="card-body ">
              <!-- <p class="card-description text-center">Or Be Classical</p> -->
              <span class="bmd-form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">face</i>
                    </span>
                  </div>
                  <?php
                  if ($show_display_name == "yes") {
                      $query = "select displayname from " . $db_prefix . "employees where disabled <> '1'  and empfullname <> 'admin' order by displayname";
                      $emp_name_result = mysqli_query($db,$query);
                      echo "<select name='left_displayname' tabindex=1>\n";
                      echo "<option value =''>...</option>\n";

                      while ($row = mysqli_fetch_array($emp_name_result)) {

                          $abc = stripslashes("" . $row['displayname'] . "");

                          if ((isset($_COOKIE['remember_me'])) && (stripslashes($_COOKIE['remember_me']) == $abc)) {
                              echo "<option selected>$abc</option>\n";
                          } else {
                              echo "<option>$abc</option>\n";
                          }

                      }

                      echo "</select>\n";
                      mysqli_free_result($emp_name_result);
                      echo "\n";

                  } else {

                      $query = "select empfullname from " . $db_prefix . "employees where disabled <> '1'  and empfullname <> 'admin' order by empfullname";
                      $emp_name_result = mysqli_query($db,$query);
                      echo "<select name='left_fullname' tabindex=1>\n";
                      echo "<option value =''>...</option>\n";

                      while ($row = mysqli_fetch_array($emp_name_result)) {

                          $def = stripslashes("" . $row['empfullname'] . "");
                          if ((isset($_COOKIE['remember_me'])) && (stripslashes($_COOKIE['remember_me']) == $def)) {
                              echo "<option selected>$def</option>\n";
                          } else {
                              echo "<option>$def</option>\n";
                          }

                      }

                      echo "</select>\n";
                      mysqli_free_result($emp_name_result);

                  }
                  ?>
                </div>

              </span>
              <span class="bmd-form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                <?php
                if ($use_passwd == "yes") {
                    echo "<input type='password' name='employee_passwd' maxlength='25' size='17' tabindex=2>\n";
                }
                 ?>
                </div>
              </span>
              <span class="bmd-form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">email</i>
                    </span>
                  </div>
                <?php
                // query to populate dropdown with punchlist items //

                $query = "select punchitems from " . $db_prefix . "punchlist";
                $punchlist_result = mysqli_query($db,$query);

                echo "<select name='left_inout' tabindex=3>\n";
                echo "<option value =''>...</option>\n";

                while ($row = mysqli_fetch_array($punchlist_result)) {
                    echo "<option>" . $row['punchitems'] . "</option>\n";
                }

                echo "              </select>\n";
                mysqli_free_result($punchlist_result);


                 ?>
                </div>
              </span>
              <span class="bmd-form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">face</i>
                  </span>
                </div>
                <?php
                echo "<input type='text' name='left_notes' maxlength='250' size='17' tabindex=4>\n";

                if (!isset($_COOKIE['remember_me'])) {
                    echo "<input type='checkbox' name='remember_me' value='1'>\n";
                } elseif (isset($_COOKIE['remember_me'])) {
                    echo "<input type='checkbox' name='reset_cookie' value='1'>\n";
                }

                 ?>
              </div>
            </span>

            </div>
            <div class="card-footer justify-content-center">
              <a href="#pablo" class="btn btn-rose btn-link btn-lg">Submit</a>
            </div>
          </div>
        </form>
      </div>
    </div>
<?php
if (!isset($_GET['printer_friendly'])) {
    include 'footer.php';
}
?>
