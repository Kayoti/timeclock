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

//include 'leftmain.php';
// display form to submit signin/signout information //
 ?>

 <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
        <form class="form" name='timeclock' id="timeclockform" method='post'>
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
                      echo "<select class='form-control' name='left_displayname'>\n";
                      echo "<option value =''>Select</option>\n";

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
                      echo "<select class='form-control' name='left_fullname' >\n";
                      echo "<option value =''>Select</option>\n";

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
                    echo "<input class='form-control'placeholder='Password' type='password' name='employee_passwd' maxlength='25'>\n";
                }
                 ?>
                </div>
              </span>
              <span class="bmd-form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">event_note</i>
                    </span>
                  </div>
                <?php
                // query to populate dropdown with punchlist items //

                $query = "select punchitems from " . $db_prefix . "punchlist";
                $punchlist_result = mysqli_query($db,$query);

                echo "<select class='form-control' name='left_inout' tabindex=3>\n";
                echo "<option value =''>Select</option>\n";

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
                    <i class="material-icons">note_add</i>
                  </span>
                </div>
                <?php
                echo "<textarea name='left_notes' class='form-control' maxlength='250'  rows='4' cols='50' placeholder='Notes'></textarea>";?>
              </div>
            </span>
          </br>
            <span class="bmd-form-group">
            <div class="input-group form-check form-check-inline">
              <div class="input-group-prepend">
                <span class="input-group-text">

                </span>
              </div>
              <label  class="form-check-label">

                <?php
                if (!isset($_COOKIE['remember_me'])) {
                  echo "<input class='form-check-input' type='checkbox' id='remember_me' name='remember_me' value='1'>";
                } elseif (isset($_COOKIE['remember_me'])) {
                  echo "<input class='form-check-input' type='checkbox' id='reset_cookie' name='reset_cookie' value='1'>";
                }
                ?>  Remeber Me
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
            </div>
          </span>


            <div class="card-footer justify-content-center">

              <button id="submit_button" name="submit_button" class="btn btn-rose btn-link btn-lg"  type="button">Submit</button>
            </div>
          </div>

            </div>

          </div>
        </form>
        <div id="errormessage" class="col-md-12">
      </div>
    </div>
<?php
if (!isset($_GET['printer_friendly'])) {
    include 'footer.php';
}
?>
