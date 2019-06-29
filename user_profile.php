<?php
include ('navbar.php');
if(!isset($_SESSION['username'])) {
  $_SESSION['error'] = "You need to login before you can view other members profiles.";
  echo '<script>';
  echo 'window.location.href="Main.php"';
  echo '</script>';

}
$username =  $_GET['username'];
$loggedinuser = $_SESSION['username'];
$isfriend = false;
$mysqli = new mysqli($host, $user, $pass, $dbName);
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
}
$query = "SELECT UserID_1, UserID_2 FROM Friends WHERE UserID_1 = '$username' AND UserID_2 = '$loggedinuser'";
if ($result = $mysqli->query($query)) {
  /* determine number of rows result set */
      $row_cnt = $result->num_rows;
      if($row_cnt != 0) {
        $isfriend = true;
      }
    /* free result set */
    $result->free();
}

if(isset($_GET['deleteid'])) {
  $deleteid = $_GET['deleteid'];
  $query = "DELETE FROM UserAttending WHERE username = '$username' AND eventid = '$deleteid'";
  $mysqli->query($query);
}

?>
<style>
  html, body {
    overflow: auto;
  }
  .fa-user-circle {
    color: grey;
    font-size: 150px;
  }
  .user-container {
    margin: 20px 0;
  }
  .addbutton {
    text-decoration: none;
    display: inline-block;
    padding: 2px 8px;
    background: ButtonFace;
    color: ButtonText;
    border-style: solid;
    border-width: 2px;

    border-color: ButtonHighlight ButtonShadow ButtonShadow ButtonHighlight;
  }
  .addbutton:hover {
      background-color: #17A2B8;
      color: white;
  }
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 ">
		     <div class="container user-container text-center">

            <i class="fas fa-user-circle"></i>
            <p><strong><?php echo $username; ?></strong></p>
            <?php
              if ($_SESSION['username'] == $username) {
                // echo '<a href="edit_profile.php?username='.$loggedinuser.'&editprofile=true" class="addbutton">Edit Profile</a>';
              } else if($isfriend) {
                echo '<i class="far fa-check-circle" style="color:green;">Friend</i><br><br>';
                echo '<a href="unfriend.php?userid1='.$loggedinuser.'&userid2='.$username.'" class="btn btn-info"><i class="fas fa-user-friends"></i> Unfriend</a>';
              } else {
                echo '<a href=add_friend.php?user1='.$_SESSION['username'].'&user2='.$username.' class="addbutton">Add Friend</a>';
              }
            ?>



          </div>
		</div>
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-8">
		                    <h4>Events <?php echo $username; ?> are attending</h4>
		                </div><br>


		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <table class="table table-hover ">
                                <thead class="bg-light ">
                                  <tr>

                                    <th>Event Name</th>
                                    <th></th>
                                  </tr>

                                </thead>
                                <tbody>
                                  <?php
                                  if(isset($_SESSION['username'])) {

                                    $query1 = "SELECT * FROM UserAttending WHERE username = '$username'";
                                    if ($result1 = $mysqli->query($query1)) {
                                        /* fetch associative array */
                                        while ($row = $result1->fetch_assoc()) {
                                          echo '<tr>
                                                  <td><a href="Main.php?EventID=' . $row["eventid"] . '""><small>'.$row["eventname"].'</small></a></td>';
                                              if ($_SESSION['username'] == $username) {
                                                echo  '<td><a href=user_profile.php?username='.$username.'&deleteid='.$row["eventid"].'><small><i class="far fa-times-circle" style="color:red;"></i> Quit</small></a></td>';
                                              }
                                          echo      '</tr>';
                                        }
                                        /* free result set */
                                        $result1->free();
                                    }

                                    /* close connection */
                                    $mysqli->close();



                                  }
                                  ?>


                                </tbody>
                              </table>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
