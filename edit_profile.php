<?php
include ('navbar.php');
$username = $_SESSION['username'];
$email = $_SESSION['email'];
if(!isset($_SESSION['username']) && !isset($_GET['editprofile'])) {
  $_SESSION['error'] = "You need to login before you can edit your profile.";
  echo '<script>';
  echo 'window.location.href="Main.php"';
  echo '</script>';

}

if(isset($_POST['save'])) {
  $u = $_POST['username'];
  $e = $_POST['email'];
  $connection=mysqli_connect($host, $user, $pass, $dbName);
  if (!$connection) {
      die('Not connected : ' . mysqli_connect_error());
  }
  $query = sprintf("UPDATE ACCOUNTS SET username = '%s',
                                      email = '%s'
                                      WHERE username = '%s'",
      mysqli_real_escape_string($connection,$u),
      mysqli_real_escape_string($connection,$e),
      mysqli_real_escape_string($connection,$username));

  $query1 = sprintf("UPDATE Events SET Host = '%s',
                                      WHERE Host = '%s'",
      mysqli_real_escape_string($connection,$u),
      mysqli_real_escape_string($connection,$username));
      echo $u;
      echo $username;
  $result1 = mysqli_query($connection,$query1);
  $result = mysqli_query($connection,$query);
  if ( false===$result ) {
    $_SESSION['error'] = "Profile failed to update.";
  } else {
    $_SESSION['email'] = $e;
    $_SESSION['username'] = $u;
    $_SESSION['success'] = "You have updated your profile!";
  }
  $username = $_SESSION['username'];
  // echo '<script>';
  // echo 'window.location.href="user_profile.php?username='.$username.'"';
  // echo '</script>';

}

echo '<div class="container-fluid ">
      	<div class="row">
      		<div class="col-md-5 ">
      		   <div class="container user-container ">
                  <i class="fas fa-user-circle" style="font-size: 150px; color: #17A2B8; margin: 20px 0;"></i><br>
                  <form action="edit_profile.php" method="POST" id="update-form">
                          <label for="username">Username</label>
                          <input type="text" form="update-form" name="username" id="username" value="'.$username.'">
                          <label for="email">Email</label>
                          <input type="text" form="update-form" name="email" id="email" value="'.$email .'">
                          <input type="submit" name="save" value="Save" style="color:white; background-color:#17A2B8;">
                  </form>
            </div>
         </div>
      </div>';
?>
