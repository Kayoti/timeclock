<?php

include 'config.inc.php';

// connect to db anc check for correct db version //
@ $db = mysqli_connect($db_hostname, $db_username, $db_password);
if (!$db) {
    echo "Error: Could not connect to the database. Please try again later.";
    exit;
}
mysqli_select_db($db,$db_name);
if(!isset($connecting_ip)) $connecting_ip="";
if(!isset($tz_stamp)) $tz_stamp="";
if(!isset($db_prefix)) $db_prefix="";
$self = $_SERVER['PHP_SELF'];
$request = $_SERVER['REQUEST_METHOD'];

// set cookie if 'Remember Me?' checkbox is checked, or reset cookie if 'Reset Cookie?' is checked //

if ($request == 'POST') {
    @$remember_me = $_POST['remember_me'];
    @$reset_cookie = $_POST['reset_cookie'];
    @$fullname = stripslashes($_POST['left_fullname']);

    @$displayname = stripslashes($_POST['left_displayname']);
    if ($remember_me && $remember_me != '1') {
        echo "Something is fishy here.\n";
        exit;
    }
    if ($reset_cookie && $reset_cookie != '1') {
        echo "Something is fishy here.\n";
        exit;
    }

    // begin post validation //

    if (isset($show_display_name) == "yes") {

        if (isset($displayname)) {
            $displayname = addslashes($displayname);
            $query = "select displayname from " . $db_prefix . "employees where displayname = '" . $displayname . "'";
            $emp_name_result = mysqli_query($db,$query);

            while ($row = mysqli_fetch_array($emp_name_result)) {
                $tmp_displayname = "" . $row['displayname'] . "";
            }
            if ((!isset($tmp_displayname)) && (!empty($displayname))) {
                echo "Username is not in the database.\n";
                exit;
            }
            $displayname = stripslashes($displayname);
        }

    } elseif (isset($show_display_name) == "no") {

        if (isset($fullname)) {
            $fullname = addslashes($fullname);
            $query = "select empfullname from " . $db_prefix . "employees where empfullname = '" . $fullname . "'";
            $emp_name_result = mysqli_query($db,$query);

            while ($row = mysqli_fetch_array($emp_name_result)) {
                $tmp_empfullname = "" . $row['empfullname'] . "";
            }
            if ((!isset($tmp_empfullname)) && (!empty($fullname))) {
                echo "Username is not in the database.\n";
                exit;
            }
            $fullname = stripslashes($fullname);
        }

    }

    // end post validation //

    if (isset($remember_me)) {

        if ($show_display_name == "yes") {
            setcookie("remember_me", stripslashes($displayname), time() + (60 * 60 * 24 * 365 * 2));
        } elseif ($show_display_name == "no") {
            setcookie("remember_me", stripslashes($fullname), time() + (60 * 60 * 24 * 365 * 2));
        }

    } elseif (isset($reset_cookie)) {
        setcookie("remember_me", "", time() - 3600);
    }

    ob_end_flush();
}

if (isset($display_weather) == 'yes') {

    include 'phpweather.php';
    $metar = get_metar($db,$db_prefix,$metar);
    $data = process_metar($db,$db_prefix,$metar);

    if ($weather_units == "f") {
        $mph = " mph";
        $miles = " miles";

        // weather info //

        if (!isset($data['temp_f'])) {
            $temp = '';
        } else {
            $temp = $data['temp_f'];
        }
        if (!isset($data['windchill_f'])) {
            $windchill = '';
        } else {
            $windchill = $data['windchill_f'];
        }
        if (!isset($data['wind_dir_text_short'])) {
            $wind_dir = '';
        } else {
            $wind_dir = $data['wind_dir_text_short'];
        }
        if (!isset($data['wind_miles_per_hour'])) {
            $wind = '';
        } else {
            $wind = round($data['wind_miles_per_hour']);
        }
        if ($wind == 0) {
            $wind_dir = 'None';
            $mph = '';
            $wind = '';
        } else {
            $wind_dir = $wind_dir;
        }
        if (!isset($data['visibility_miles'])) {
            $visibility = '';
        } else {
            $visibility = $data['visibility_miles'] . $miles;
        }
        if (!isset($data['rel_humidity'])) {
            $humidity = 'None';
        } else {
            $humidity = round($data['rel_humidity'], 0);
        }
        if (!isset($data['time'])) {
            $time = '';
        } else {
            $time = date($timefmt, $data['time']);
        }
        if (!isset($data['cloud_layer1_condition'])) {
            $cloud_cover = '';
        } else {
            $cloud_cover = $data['cloud_layer1_condition'];
        }
        if (($temp <> '') && ($temp >= '70') && ($humidity <> '')) {
            $heatindex = number_format(-42.379 + (2.04901523 * $temp) + (10.1433312 * $humidity) - (0.22475541 * $temp * $humidity)
                                       - (0.00683783 * ($temp * $temp)) - (0.05481717 * ($humidity * $humidity))
                                       + (0.00122874 * ($temp * $temp) * $humidity) + (0.00085282 * $temp * ($humidity * $humidity))
                                       - (0.00000199 * ($temp * $temp) * ($humidity * $humidity)));
        }
    } else {
        $mph = " kmh";
        $miles = " km";

        // weather info //

        if (!isset($data['temp_c'])) {
            $temp = '';
        } else {
            $temp = $data['temp_c'];
        }
        if (!isset($data['temp_f'])) {
            $tempF = '';
        } else {
            $tempF = $data['temp_f'];
        }
        if (!isset($data['windchill_c'])) {
            $windchill = '';
        } else {
            $windchill = $data['windchill_c'];
        }
        if (!isset($data['wind_dir_text_short'])) {
            $wind_dir = '';
        } else {
            $wind_dir = $data['wind_dir_text_short'];
        }
        if (!isset($data['wind_meters_per_second'])) {
            $wind = '';
        } else {
            $wind = round($data['wind_meters_per_second'] / 1000 * 60 * 60);
        }
        if ($wind == 0) {
            $wind_dir = 'None';
            $mph = '';
            $wind = '';
        } else {
            $wind_dir = $wind_dir;
        }
        if (!isset($data['visibility_km'])) {
            $visibility = '';
        } else {
            $visibility = $data['visibility_km'] . $miles;
        }
        if (!isset($data['rel_humidity'])) {
            $humidity = 'None';
        } else {
            $humidity = round($data['rel_humidity'], 0);
        }
        if (!isset($data['time'])) {
            $time = '';
        } else {
            $time = date($timefmt, $data['time']);
        }
        if (!isset($data['cloud_layer1_condition'])) {
            $cloud_cover = '';
        } else {
            $cloud_cover = $data['cloud_layer1_condition'];
        }
        if (($tempF <> '') && ($tempF >= '70') && ($humidity <> '')) {
            $heatindexF = number_format(-42.379 + (2.04901523 * $tempF) + (10.1433312 * $humidity) - (0.22475541 * $tempF * $humidity)
                                        - (0.00683783 * ($tempF * $tempF)) - (0.05481717 * ($humidity * $humidity))
                                        + (0.00122874 * ($tempF * $tempF) * $humidity) + (0.00085282 * $tempF * ($humidity * $humidity))
                                        - (0.00000199 * ($tempF * $tempF) * ($humidity * $humidity)));
            $heatindex = round(($heatindexF - 32) * 5 / 9);
        }
    }

    if ((isset($heatindex)) || ($windchill <> '')) {
        if (!isset($heatindex)) {
            $feelslike = $windchill;
        } else {
            $feelslike = $heatindex;
        }
    } else {
        $feelslike = $temp;
    }
}

// echo "<table width=100% height=89% border=0 cellpadding=0 cellspacing=1>\n";
// echo "  <tr valign=top>\n";
// echo "    <td class=left_main width=170 align=left scope=col>\n";
// echo "      <table class=hide width=100% border=0 cellpadding=1 cellspacing=0>\n";

// display links in top left of each page //

if (isset($links) == "none") {
    echo "        <tr></tr>\n";
} else {
    echo "        <tr><td class=left_rows height=7 align=left valign=middle></td></tr>\n";

    for ($x = 0; $x < is_array(count($display_links)); $x++) {
        echo "        <tr><td class=left_rows height=18 align=left valign=middle><a class=admin_headings href='$links[$x]' target='_new'>$display_links[$x]</a></td>
                      </tr>\n";
    }

}
if ($request == 'POST') {

    // signin/signout data passed over from timeclock.php //

    $inout = $_POST['left_inout'];
    $notes = preg_replace("/[^[:alnum:] \\,\.\?-]/", "", strtolower($_POST['left_notes']));

    // begin post validation //

    if (isset($use_passwd) == "yes") {

        $employee_passwd = crypt($_POST['employee_passwd'], 'xy');

    }

    $query = "select punchitems from ".$db_prefix."punchlist";
    $punchlist_result = mysqli_query($db,$query);

    while ($row = mysqli_fetch_array($punchlist_result)) {

        $tmp_inout = "" . $row['punchitems'] . "";
    }

    if (!isset($tmp_inout)) {
        echo '
        <div class="alert alert-danger">
  <div class="container">
    <div class="alert-icon">
      <i class="material-icons">error_outline</i>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true"><i class="material-icons">clear</i></span>
    </button>
    <b>Error Alert:</b>
    <p >In/Out Status is not in the database.</p>
  </div>
</div>
        ';
        exit;
    }

    // end post validation //

    if ($show_display_name == "yes") {

        if (!$displayname && !$inout) {
            // echo "    <td align=left class=right_main scope=col>\n";
            // echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
            // echo "        <tr class=right_main_text>\n";
            // echo "          <td valign=top>\n";
            echo "<br />\n";

            echo '
            <div class="alert alert-danger">
      <div class="container">
        <div class="alert-icon">
          <i class="material-icons">error_outline</i>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
        <b>Error Alert:</b>
        <p >You have not chosen a username or a status. Please try again.</p>
      </div>
    </div>


            ';
            //include 'footer.php';
            exit;
        }

        if (!$displayname) {
            // echo "    <td align=left class=right_main scope=col>\n";
            // echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
            // echo "        <tr class=right_main_text>\n";
            // echo "          <td valign=top>\n";
            echo "<br />\n";

            echo '
            <div class="alert alert-danger">
      <div class="container">
        <div class="alert-icon">
          <i class="material-icons">error_outline</i>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
        <b>Error Alert:</b>
        <p >You have not chosen a username. Please try again.</p>
      </div>
    </div>


            ';
            //include 'footer.php';
            exit;
        }

    } elseif ($show_display_name == "no") {

        if (!$fullname && !$inout) {
            // echo "    <td align=left class=right_main scope=col>\n";
            // echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
            // echo "        <tr class=right_main_text>\n";
            // echo "          <td valign=top>\n";
            echo "<br />\n";

            echo '
            <div class="alert alert-danger">
      <div class="container">
        <div class="alert-icon">
          <i class="material-icons">error_outline</i>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
        <b>Error Alert:</b>
        <p >You have not chosen a username or a status. Please try again.</p>
      </div>
    </div>


            ';
            //include 'footer.php';
            exit;
        }

        if (!$fullname) {
            // echo "    <td align=left class=right_main scope=col>\n";
            // echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
            // echo "        <tr class=right_main_text>\n";
            // echo "          <td valign=top>\n";
            echo "<br />\n";

            echo '
            <div class="alert alert-danger">
      <div class="container">
        <div class="alert-icon">
          <i class="material-icons">error_outline</i>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
        <b>Error Alert:</b>
        <p >You have not chosen a username. Please try again.</p>
      </div>
    </div>


            ';
            //include 'footer.php';
            exit;
        }

    }

    if (!$inout) {
        // echo "    <td align=left class=right_main scope=col>\n";
        // echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
        // echo "        <tr class=right_main_text>\n";
        // echo "          <td valign=top>\n";
        echo "<br />\n";


        echo '
        <div class="alert alert-danger">
  <div class="container">
    <div class="alert-icon">
      <i class="material-icons">error_outline</i>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true"><i class="material-icons">clear</i></span>
    </button>
    <b>Error Alert:</b>
    <p >You have not chosen a status. Please try again.</p>
  </div>
</div>


        ';
        //include 'footer.php';
        exit;
    }

    @$fullname = addslashes($fullname);
    @$displayname = addslashes($displayname);

    // configure timestamp to insert/update //

    $time = time();
    $hour = gmdate('H', $time);
    $min = gmdate('i', $time);
    $sec = gmdate('s', $time);
    $month = gmdate('m', $time);
    $day = gmdate('d', $time);
    $year = gmdate('Y', $time);
    $tz_stamp = mktime($hour, $min, $sec, $month, $day, $year);

    if ($use_passwd == "no") {

        if ($show_display_name == "yes") {

            $sel_query = "select empfullname from " . $db_prefix . "employees where displayname = '" . $displayname . "'";
            $sel_result = mysqli_query($db,$sel_query);

            while ($row = mysqli_fetch_array($sel_result)) {
                $fullname = stripslashes("" . $row["empfullname"] . "");
                $fullname = addslashes($fullname);
            }
        }

        if (strtolower($ip_logging) == "yes") {
            $query = "insert into " . $db_prefix . "info (fullname, `inout`, timestamp, notes, ipaddress) values ('" . $fullname . "', '" . $inout . "',
                      '" . $tz_stamp . "', '" . $notes . "', '" . $connecting_ip . "')";
        } else {
            $query = "insert into " . $db_prefix . "info (fullname, `inout`, timestamp, notes) values ('" . $fullname . "', '" . $inout . "', '" . $tz_stamp . "',
                      '" . $notes . "')";
        }

        $result = mysqli_query($db,$query);

        $update_query = "update " . $db_prefix . "employees set tstamp = '" . $tz_stamp . "' where empfullname = '" . $fullname . "'";
        $other_result = mysqli_query($db,$update_query);
        echo '
        <div class="alert alert-success">
      <div class="container">
      <div class="alert-icon">
      <i class="material-icons">check</i>
      </div>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true"><i class="material-icons">clear</i></span>
      </button>
      <b></b>
      <p >You have Successfully set your status to "'.$inout.'"</br>';
      if($notes!=""){echo "with the following note: ".$notes."</p></div>
      </div>";}else{
        echo "</p></div></div>";
      }


        // echo "<head>\n";
        // echo "<meta http-equiv='refresh' content=0;url=index.php>\n";
        // echo "</head>\n";

    } else {

        if ($show_display_name == "yes") {

            $sel_query = "select empfullname, employee_passwd from " . $db_prefix . "employees where displayname = '" . $displayname . "'";
            $sel_result = mysqli_query($db,$sel_query);

            while ($row = mysqli_fetch_array($sel_result)) {

                $tmp_password = "" . $row["employee_passwd"] . "";
                $fullname = "" . $row["empfullname"] . "";
            }

            $fullname = stripslashes($fullname);

            $fullname = addslashes($fullname);

        } else {

            $sel_query = "select empfullname, employee_passwd from " . $db_prefix . "employees where empfullname = '" . $fullname . "'";
            $sel_result = mysqli_query($db,$sel_query);

            while ($row = mysqli_fetch_array($sel_result)) {

                $tmp_password = "" . $row["employee_passwd"] . "";
            }

        }

        if ($employee_passwd == $tmp_password) {

            if (strtolower($ip_logging) == "yes") {
                $query = "insert into " . $db_prefix . "info (fullname, `inout`, timestamp, notes, ipaddress) values ('" . $fullname . "', '" . $inout . "',
                      '" . $tz_stamp . "', '" . $notes . "', '" . $connecting_ip . "')";
            } else {
                $query = "insert into " . $db_prefix . "info (fullname, `inout`, timestamp, notes) values ('" . $fullname . "', '" . $inout . "', '" . $tz_stamp . "',
                      '" . $notes . "')";
            }

            $result = mysqli_query($db,$query);

            $update_query = "update " . $db_prefix . "employees set tstamp = '" . $tz_stamp . "' where empfullname = '" . $fullname . "'";
            $other_result = mysqli_query($db,$update_query);
            echo '
            <div class="alert alert-success">
          <div class="container">
          <div class="alert-icon">
          <i class="material-icons">check</i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
          </button>
          <b></b>
          <p >You have Successfully set your status to "'.$inout.'"</br>';
          if($notes!=""){echo "with the following note: ".$notes."</p></div>
          </div>";}else{
            echo "</p></div></div>";
          }
            // echo "<head>\n";
            // echo "<meta http-equiv='refresh' content=0;url=index.php>\n";
            // echo "</head>\n";

        } else {

            // echo "    <td align=left class=right_main scope=col>\n";
            // echo "      <table width=100% height=100% border=0 cellpadding=10 cellspacing=1>\n";
            // echo "        <tr class=right_main_text>\n";
            // echo "          <td valign=top>\n";
            echo "<br />\n";

            if ($show_display_name == "yes") {
                $strip_fullname = stripslashes($displayname);
            } else {
                $strip_fullname = stripslashes($fullname);
            }


            echo '
            <div class="alert alert-danger">
      <div class="container">
        <div class="alert-icon">
          <i class="material-icons">error_outline</i>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
        <b>Error Alert:</b>
        <p >You have entered the wrong password for '.$strip_fullname.' Please try again.</p>
      </div>
    </div>


            ';
            //include 'footer.php';
            exit;
        }

    }
}
?>
