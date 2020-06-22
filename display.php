    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header-primary">

            <?php if (!isset($_GET['printer_friendly'])) { ?>
            <p class="card-title "> <a class="nav-link" href="timeclock.php?printer_friendly=true">
            <i style="color:white;" class="material-icons">print</i>
          </a></p>
        <?php } ?>
          </div>
          <div class="card-body">
            <div class="table-responsive">
<?php

$row_count = 0;
$page_count = 0;

while ($row = mysqli_fetch_array($result)) {

    $display_stamp = "" . $row["timestamp"] . "";
    $time = date($timefmt, $display_stamp);
    $date = date($datefmt, $display_stamp);

    if ($row_count == 0) {
        if ($page_count == 0) {
            // display sortable column headings for main page //
            echo "<table class='table-hover table'>";
            echo "<thead class='text-primary'>";
            echo "<td><a class='' href='".$current_page."?sortcolumn=empfullname&sortdirection=".$sortnewdirection."'>Name</a></td>";
            echo "<td><a class='' href='".$current_page."?sortcolumn=inout&sortdirection=".$sortnewdirection."'>In/Out</a></td>";
            echo "<td><a class='' href='".$current_page."?sortcolumn=tstamp&sortdirection=".$sortnewdirection."'>Time</a></td>";
            echo "<td><a class='' href='".$current_page."?sortcolumn=tstamp&sortdirection=".$sortnewdirection."'>Date</a></td>";
            if ($display_office_name == "yes") {
                echo "<td><a class='' href='".$current_page."?sortcolumn=office&sortdirection=".$sortnewdirection."'>Office</a></td>";
            }
            if ($display_group_name == "yes") {
                echo "<td><a class='' href='".$current_page."?sortcolumn=groups&sortdirection=".$sortnewdirection."'>Group</a></td>";
            }
            echo "<td><a class='' href='".$current_page."?sortcolumn=notes&sortdirection=".$sortnewdirection."'><u>Notes</u></a></td>";
            echo "

            </thead>";

        } else {
            // display report name and page number of printed report above the column headings of each printed page //
            $temp_page_count = $page_count + 1;
        }
  if ($page_count > 0) {
        echo "<thead class='text-primary'>";
        echo "<th>Name</th>";
        echo "<th>In/Out</th>";
        echo "<th>Time</th>";
        echo "<th>Date</th>";

        if ($display_office_name == "yes") {
            echo "<th >Office</th>";
        }

        if ($display_group_name == "yes") {
            echo "<th >Group</th>";
        }
        echo "<th ><a >Notes</th>";
        echo "</thead>";
    }
  }

    // begin alternating row colors //

    $row_color = ($row_count % 2) ? $color1 : $color2;

    // display the query results //

    $display_stamp = $display_stamp + @$tzo;
    $time = date($timefmt, $display_stamp);
    $date = date($datefmt, $display_stamp);
echo "<tbody>";
    if ($show_display_name == "yes") {
        echo stripslashes("<tr ><td  >" . $row["displayname"] . "</td>\n");
    } elseif ($show_display_name == "no") {
        echo stripslashes("<tr ><td   >" . $row["empfullname"] . "</td>\n");
    }

    echo "<td>" . $row["inout"] . "</td>\n";
    echo "<td  >" . $time . "</td>\n";
    echo "<td  >" . $date . "</td>\n";

    if ($display_office_name == "yes") {
        echo "<td>" . $row["office"] . "</td>\n";
    }

    if ($display_group_name == "yes") {
        echo "<td>" . $row["groups"] . "</td>\n";
    }

    echo stripslashes("<td>" . $row["notes"] . "</td>\n");
    echo "</tr>\n";

    $row_count++;

    // output 40 rows per printed page //

    if ($row_count == 40) {
        echo "<tr style=\"page-break-before:always;\"></tr>\n";
        $row_count = 0;
        $page_count++;
    }

}

echo "</tbody></table>\n";

if (!isset($_GET['printer_friendly'])) {
    echo "</td></tr>\n";
}
?>
</div><!-- end of div table-responsive-->
</div><!-- end of div card body-->
</div><!-- end of div card-->
</div><!-- end of div col md 12 -->
</div><!-- end of div row -->
<?php
mysqli_free_result($result);
?>
