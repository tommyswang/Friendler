<?php
include 'config.php';
$mysqli = new mysqli($host, $user, $pass, $dbName);
if(isset($_POST['deleteid'])) {
  $deleteid = $_POST['deleteid'];
  $username = $_POST['username'];
  $query = "DELETE FROM UserAttending WHERE username = '$username' AND eventid = '$deleteid'";
  $mysqli->query($query);
}
$_SESSION['success'] = "You have quit the event.";
echo '<script>';
echo 'window.location.href="Main.php?EventID='.$deleteid.'"';
echo '</script>';

 ?>
