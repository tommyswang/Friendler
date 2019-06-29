<?php
include ('navbar.php');
echo "<style>
        html, body {
            overflow: auto;
        }
      </style>";
$loggedinuser = $_SESSION['username'];
$mysqli = new mysqli($host, $user, $pass, $dbName);
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
}
$query = "SELECT UserID_2 FROM Friends WHERE UserID_1 = '$loggedinuser'";
if ($result = $mysqli->query($query)) {
    /* fetch associative array */

    echo '<div class="container text-center" style="width:300px; margin-top: 50px;"><h2>Friends List</h2>';
    while ($row = $result->fetch_assoc()) {
      $friend = $row["UserID_2"];
      echo '
            <div class="card my-3">
                <div class="card-body">
                  <h5 class="card-title"><a href="user_profile.php?username='.$friend.'">'.$friend.'</a></h5>
                  <a href="unfriend.php?userid1='.$loggedinuser.'&userid2='.$friend.'" class="btn btn-info"><i class="fas fa-user-friends"></i> Unfriend</a>
                </div>
            </div>
            ';
    }
    echo '</div>';
  }




 ?>
