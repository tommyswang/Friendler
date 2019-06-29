<?php
include ('navbar.php');
$username = $_SESSION['username'];
echo "<style>
        html, body {
            overflow: auto;
        }
      </style>";


      $mysqli = new mysqli($host, $user, $pass, $dbName);
      /* check connection */
      if ($mysqli->connect_errno) {
          printf("Connect failed: %s\n", $mysqli->connect_error);
      }
      $query = "SELECT * FROM Events";
      echo '<div class="container">';
      if ($result = $mysqli->query($query)) {
          /* fetch associative array */
          while ($row = $result->fetch_assoc()) {
            echo '<div class="card my-3">
                      <div class="card-body">
                        <h5 class="card-title">'.$row['Event'].'</h5>
                        <p class="card-text"><i class="fas fa-map-pin" style="color:red;"></i>' . ' '. $row["Address"] . '</p>
                        <p class="card-text"><i class="far fa-clock"> Start:</i>' . ' '. $row["Start_time"] . '</p>
                        <p class="card-text"><i class="far fa-clock"> End:   </i>' . '  '. $row["End_time"] . '</p>
                        <p class="card-text">'.$row['Event_Description_Agenda'].'</p>';
                        echo "<p style='color: grey;'>Whos Going? </p>";
                        $eventid = $row['id'];
                        $joined = false;
                        $query1 = "SELECT * FROM UserAttending WHERE username = '$username' AND eventid = '$eventid'";
                        if ($result1 = $mysqli->query($query1)) {
                          /* determine number of rows result set */
                              $row_cnt = $result1->num_rows;
                              if($row_cnt != 0) {
                                $joined = true;
                              }
                        }
                        $query2 = "SELECT * FROM UserAttending WHERE eventid = '$eventid'";
                        if($result2 = $mysqli->query($query2)) {
                          while ($row2 = $result2->fetch_assoc()) {
                            echo '<a href="user_profile.php?username='.$row2['username'].'" style="color:#17A2B8">'.$row2['username'].' | </a>';
                          }
                        }
                          if (!$joined) {
                            echo '<br><a href="event_action.php?eid='.$row['id'].'&eventname='.$row['Event'].'" class="btn btn-info">Join</a>';
                            echo '</form>';
                          } else {
                              echo '
                                    </form><form action="quit_event.php" method="POST">
                                    <a href="Main.php?EditEventID='.$row['id'].'" class="btn btn-info">Edit</a>
                                    <input type="hidden" name="username" value='.$_SESSION['username'].'>
                                    <input type="hidden" name="deleteid" value='.$row['id'].'>
                                    ';
                              echo '<input style="background-color: red; bottom: 0; padding: 7px 0; margin: 0; border-radius: 1; width: 15%;" type="submit" name="quit" value="Quit Event">
                                    </form>
                                    ';

                          }





                echo'
                      </div>
                    </div>';
          }
      echo '</div>';
          /* free result set */
          $result->free();

      /* close connection */
      $mysqli->close();
      }









// echo '<div class="card my-3">
//           <div class="card-header">
//             Featured
//           </div>
//           <div class="card-body">
//             <h5 class="card-title">Special title treatment</h5>
//             <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
//             <a href="#" class="btn btn-primary">Go somewhere</a>
//           </div>
//         </div>';
 ?>
