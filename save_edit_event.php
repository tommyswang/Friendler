<?php
include 'config.php';
$event = $_POST["event-name"];
$start_time = $_POST["start-time"];
$end_time = $_POST["end-time"];
$description = $_POST["description"];
$address = $_POST["address"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$category = $_POST["category"];
$eid = $_POST["eid"];
if(isset($_POST["save-edit-submit"])) {
  $connection=mysqli_connect($host, $user, $pass, $dbName);
  if (!$connection) {
      die('Not connected : ' . mysqli_connect_error());
  }
  $query = sprintf("UPDATE Events SET Event = '%s',
                                      Start_time = '%s',
                                      End_time = '%s',
                                      Event_Description_Agenda = '%s',
                                      Address = '%s',
                                      Latitude = '%s',
                                      Longitude = '%s',
                                      Classification = '%s'
                                      WHERE id = '%s'",
      mysqli_real_escape_string($connection,$event),
      mysqli_real_escape_string($connection,$start_time),
      mysqli_real_escape_string($connection,$end_time),
      mysqli_real_escape_string($connection,$description),
      mysqli_real_escape_string($connection,$address),
      mysqli_real_escape_string($connection,$lat),
      mysqli_real_escape_string($connection,$lng),
      mysqli_real_escape_string($connection,$category),
      mysqli_real_escape_string($connection,$eid));

  $result = mysqli_query($connection,$query);
  if ( false===$result ) {
    $_SESSION['error'] = "Event failed to update.";
  } else {
    $_SESSION['success'] = "You have updated the event, ".$event."!";
  }
  echo '<script>';
  echo 'window.location.href="Main.php?EventID='.$eid.'"';
  echo '</script>';

}


?>
