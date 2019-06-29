<?php
include ('navbar.php');
if(!isset($_SESSION['username'])) {
  $_SESSION['error'] = "You need to login before you can see all the users.";
  echo '<script>';
  echo 'window.location.href="Main.php"';
  echo '</script>';

}
$username = $_SESSION['username'];
$friendList = array();
$sql = "SELECT UserID_2 FROM Friends WHERE UserID_1 = '$username'";
$result = mysqli_query($connection,$sql);
while($row = mysqli_fetch_array($result)) {
  array_push($friendList, $row['UserID_2']);
}

 ?>
<div class="container text-center" style="width: 600px; margin-top: 50px;">
  <div class="col-md-12">
      <div class="card">
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                      <h4>All Users</h4>
                  </div><br>


              </div>
              <div class="row">
                  <div class="col-md-12">
                      <table class="table table-hover ">
                              <thead class="bg-light ">
                                <tr>

                                  <th>Username</th>
                                  <th></th>
                                </tr>

                              </thead>
                              <tbody>
                                <?php



                                if(isset($_SESSION['username'])) {

                                  $query = "SELECT * FROM ACCOUNTS";
                                  $result = mysqli_query($connection,$query);

                                      /* fetch associative array */
                                      while($row = mysqli_fetch_array($result)) {
                                        if ($row["username"] != $username) {
                                          echo '<tr>
                                                  <td><a href="user_profile.php?username=' . $row["username"] . '""><small>'.$row["username"].'</small></a></td>';
                                              if (!in_array($row["username"], $friendList)) {
                                                echo  '<td><a href=add_friend.php?user1='.$username.'&user2='.$row["username"].'><small style="color:#17A2B8;"><i class="far fa-plus-square"></i> Add</small></a></td>';
                                              } else if (in_array($row["username"], $friendList)) {
                                                echo  '<td><a href=unfriend.php?userid1='.$username.'&userid2='.$row["username"].'><small style="color:red;"><i class="far fa-minus-square"></i> Unfriend</small></a></td>';
                                              }
                                          echo '</tr>';
                                        }

                                      }
                                      /* free result set */
                                      $result->free();
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
