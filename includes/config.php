<?php
  ob_start(); // start output buffering
  $timezone = date_default_timezone_set("Europe/Zurich"); // https://www.php.net/manual/en/timezones.php

  $con = mysqli_connect('localhost', 'root', 'boner', 'slotify');
  if (mysqli_connect_errno()) {
    echo 'Failed to connect to database' . mysqli_connect_errno(); 
  }
?>