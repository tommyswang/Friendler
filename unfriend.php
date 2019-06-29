<?php
include 'config.php';
$mysqli = new mysqli($host, $user, $pass, $dbName);
if(isset($_GET['userid1'])) {
  $userid1 = $_GET['userid1'];
  $userid2 = $_GET['userid2'];
  $query1 = "DELETE FROM Friends WHERE UserID_1 = '$userid1' AND UserID_2 = '$userid2'";
  $query2 = "DELETE FROM Friends WHERE UserID_1 = '$userid2' AND UserID_2 = '$userid1'";
  $mysqli->query($query1);
  $mysqli->query($query2);
}
$_SESSION['success'] = "You have unfriended " . $userid2;
echo '<script>';
echo 'window.location.href="friends_list.php?username='.$userid1.'"';
echo '</script>';

 ?>
