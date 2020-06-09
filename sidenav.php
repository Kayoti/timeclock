<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="index.php" class="simple-text logo-normal">
        <img border=0 src='<?php echo $logo; ?>'>
      </a></div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item active  ">
          <a class="nav-link" href="./dashboard.html">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item ">
          <a class="nav-link" href="./punch_in_out_form.php">
            <i class="material-icons">content_paste</i>
            <p>Punch In/Out</p>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="./punchclock/menu.php">
            <i class="material-icons">library_books</i>
            <p>Timecard</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
