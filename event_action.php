<?php
  require('config.php');
  $eventid =  $_GET['eid'];
  if(isset($_GET['eid']) && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $eventname = $_GET['eventname'];
    $eventname = mysqli_real_escape_string($eventname);
    $query = "INSERT INTO UserAttending (username, eventid, eventname)
  			  VALUES('$username', '$eventid','$eventname')";
  	mysqli_query($connection, $query);
    $_SESSION['success'] = "You have joined the event!";

  } else {
    $_SESSION['error'] = "You have to be logged in before you can join any events.";
  }
  echo '<script>';
  echo 'window.location.href="Main.php?EventID='.$eventid.'"';
  echo '</script>';

 ?>
<!-- when join event is clicked -->

<!-- Add username and eventid into the userattending table -->
