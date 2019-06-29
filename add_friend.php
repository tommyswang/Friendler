<?php
include('config.php');
$userid1 = $_GET['user1'];
$userid2 = $_GET['user2'];
$connection=mysqli_connect ($host, $user, $pass, $dbName);
if (!$connection) {
    die('Not connected : ' . mysqli_connect_error());
}
// Inserts new row with place data.
$query1 = sprintf("INSERT INTO Friends " .
    " (UserID_1, UserID_2) " .
    " VALUES ('%s', '%s');",
    mysqli_real_escape_string($connection,$userid1),
    mysqli_real_escape_string($connection,$userid2));
$query2 = sprintf("INSERT INTO Friends " .
    " (UserID_1, UserID_2) " .
    " VALUES ('%s', '%s');",
    mysqli_real_escape_string($connection,$userid2),
    mysqli_real_escape_string($connection,$userid1));
$result1 = mysqli_query($connection,$query1);
$result2 = mysqli_query($connection,$query2);
$_SESSION['success'] = "You have successfully added, ".$userid2." as a friend!";
echo '<script>';
echo 'window.location.href="user_profile.php?username='.$userid2.'"';
echo '</script>';
?>
