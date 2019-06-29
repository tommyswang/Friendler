<?php
include 'navbar.php';
include 'locations_model.php';
$id = 17;
$username = $_SESSION['username'];
?>

<script type="text/javascript" src="js/googlemap.js"></script>
<div id="wrapper">
    <!-- Left Fixed Div -->
    <div id="left-div">
      <div class="container">
        <?php
        if(isset($_GET['EditEventID']) && isset($_SESSION['username'])) {
          $EditEventID = $_GET['EditEventID'];
          $mysqli = new mysqli($host, $user, $pass, $dbName);
          if ($mysqli->connect_errno) {
              printf("Connect failed: %s\n", $mysqli->connect_error);
          }
          $query = "SELECT * FROM Events WHERE id = '$EditEventID'";

          if ($result = $mysqli->query($query)) {
              /* fetch associative array */
              while ($row = $result->fetch_assoc()) {
                echo '     <form action="save_edit_event.php" id="save_edit_event" method="POST">
                              <input type="hidden" name="eid" value="'.$EditEventID.'">
                              <h4 class="text-center form-title">Edit Event</h4>
                              <label for="event-name" required>Event Name</label>
                              <input type="text" id="event-name" name="event-name" placeholder="Event Name" value="'.$row["Event"].'">

                              <label for="description">Event Description</label>
                              <input type="text" id="description" name="description" placeholder="Event Description" value="'.$row["Event_Description_Agenda"].'">

                              <label for="lat">Latitude</label>
                              <input type="text" id="lat" name="lat" placeholder="Latitude" value="'.$row["Latitude"].'">

                              <label for="lng">Longitude</label>
                              <input type="text" id="lng" name="lng" placeholder="Longitude" value="'.$row["Longitude"].'">

                              <label for="address">Address</label>
                              <input type="text" id="address" name="address" placeholder="Address" value="'.$row["Address"].'">

                              <label for="start-time">Start Time</label>
                              <input type="datetime" id="start-time" name="start-time" value="'.$row["Start_time"].'">

                              <label for="end-time">End Time</label>
                              <input type="datetime" id="end-time" name="end-time" value="'.$row["End_time"].'">

                              <label for="category">Event Category</label>
                              <select id="category" name="category">
                                <option selected value="'.$row["Classification"].'">'.$row["Classification"].'</option>
                                <option value="art">Art</option>
                                <option value="civic">Civic</option>
                                <option value="community">Community</option>
                                <option value="business">Business</option>
                                <option value="education">Education</option>
                                <option value="special">Special</option>
                                <option value="recreation">Recreation</option>
                                <option value="other">Other</option>
                              </select>
                              <input type="submit" name="save-edit-submit" value="Save" style="color:white; background-color:#17A2B8;">
                          </form>';
              }
            }
        }
          else if(!isset($_GET['EventID']) && isset($_SESSION['username'])) {
            echo '     <form action="Main.php" id="signupForm" method="get">
                          <h4 class="text-center form-title">Create an Event</h4>
                          <label for="event-name" required>Event Name</label>
                          <input type="text" id="event-name" name="event-name" placeholder="Event Name">

                          <label for="description">Event Description</label>
                          <input type="text" id="description" name="description" placeholder="Event Description">

                          <label for="lat">Latitude</label>
                          <input type="text" id="lat" name="lat" placeholder="Latitude">

                          <label for="lng">Longitude</label>
                          <input type="text" id="lng" name="lng" placeholder="Longitude">

                          <label for="address">Address</label>
                          <input type="text" id="address" name="address" placeholder="Address">

                          <label for="start-time">Start Time</label>
                          <input type="datetime-local" id="start-time" name="start-time">

                          <label for="end-time">End Time</label>
                          <input type="datetime-local" id="end-time" name="end-time">

                          <label for="category">Event Category</label>
                          <select id="category" name="category">
                            <option value="art">Art</option>
                            <option value="civic">Civic</option>
                            <option value="community">Community</option>
                            <option value="business">Business</option>
                            <option value="education">Education</option>
                            <option value="special">Special</option>
                            <option value="recreation">Recreation</option>
                            <option value="other">Other</option>
                          </select>
                          <input type="submit" value="Create" style="color:white; background-color:#17A2B8;">
                      </form>';
          } else if(isset($_GET['EventID']) || isset($id)) {
              if(isset($_GET['EventID'])) {
                $id = $_GET['EventID'];
              }
              $mysqli = new mysqli($host, $user, $pass, $dbName);
              /* check connection */
              if ($mysqli->connect_errno) {
                  printf("Connect failed: %s\n", $mysqli->connect_error);
              }
              $query = "SELECT * FROM Events WHERE id = '$id'";
              if ($result = $mysqli->query($query)) {
                  /* fetch associative array */
                  while ($row = $result->fetch_assoc()) {
                      echo '<div align="right" id="event-close-btn"><a href="Main.php"><i class="fas fa-times"></i></a></div>';
                      echo '<div>';

                      echo '<h4 id="event-header-name" style="display:inline;">' .$row["Event"] . '</h4><br>';
                      if(isset($_SESSION['username'])) {
                        echo'  <div class="dropdown">
                              <button class="dropbtn" style="display:block !important;"><i class="sm-hover-transition fas fa-ellipsis-h"> </i></button>
                              <div class="dropdown-content" style="left:0;">
                                <a href="Main.php?EditEventID=' . $id . '">Edit</a>
                              </div>
                            </div><br>';
                          }
                      if($row["Host"] != '') {
                        echo '<p>Hosted by: <a href="user_profile.php?username=' . $row["Host"] . '" class="sm-hover-transition form-title">' .$row["Host"] . '</a></p>';
                      }

                      echo '<i class="fas fa-map-pin" style="color:red;"></i>' . ' '. $row["Address"] . '<br>';
                      echo '<br><p>Whos going?</p>';
                      $query2 = "SELECT * FROM UserAttending WHERE eventid = '$id'";
                      if($result2 = $mysqli->query($query2)) {
                        while ($row2 = $result2->fetch_assoc()) {
                          echo '<a href="user_profile.php?username='.$row2['username'].'" style="color:#17A2B8">'.$row2['username'].' | </a>';
                        }
                      }
                      echo '<br><br><i class="far fa-clock"> Start:</i>' . ' '. $row["Start_time"] . '<br>';
                      echo '<i class="far fa-clock"> End:   </i>' . '  '. $row["End_time"] . '<br><br>';
                      echo '<p>Description:</p>'. $row["Event_Description_Agenda"];
                      echo '<form action="event_action.php" method="GET" id="join-form">
                              <input type="hidden" form="join-form" name="eid" value="'.$id.'">
                              <input type="hidden" form="join-form" name="eventname" value="'.$row["Event"] .'">';

                      $eventid = $_GET['EventID'];
                      $joined = false;
                      $query = "SELECT * FROM UserAttending WHERE username = '$username' AND eventid = '$eventid'";
                      if ($result = $mysqli->query($query)) {
                        /* determine number of rows result set */
                            $row_cnt = $result->num_rows;
                            if($row_cnt != 0) {
                              $joined = true;
                            }
                          /* free result set */
                          $result->free();
                      }
                        if (!$joined) {
                          echo '<input style="position: absolute; left: 0; bottom: 0; margin: 0; border-radius: 1; width: 25%;" form="join-form" type="submit" name="join" value="Join Event">';
                          echo '</form>';
                        } else {
                            echo '</form><form action="quit_event.php" method="POST">
                                  <input type="hidden" name="username" value='.$_SESSION['username'].'>
                                  <input type="hidden" name="deleteid" value='.$id.'>';
                            echo '<input style="position: absolute; left: 0; background-color: red; bottom: 0; margin: 0; border-radius: 1; width: 25%;" type="submit" name="quit" value="Quit Event">
                                  </form>';
                        }




                      echo "</div>";
                  }
                  /* free result set */
                  $result->free();
              }

              /* close connection */
              $mysqli->close();
          }
        ?>

      </div>
    </div>

    <!-- Right Fixed Div -->
    <div id="right-div" style="padding-bottom:0;">
      <div class="container">
        <?php
          require 'location.php';
          $loc = new Location;
          $coll = $loc->getLocsBlankLatLng();
          $coll = json_encode($coll, true);
          echo '<div id="data">' . $coll . '</div>';

          $allData = $loc->getAll();
          $allData = json_encode($allData, true);
          echo '<div id="allData">' . $allData . '</div>';
         ?>
        <div id="map"></div>
      </div>
    </div>
</div><!-- /#wrapper -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzzGIlRKgp-dWmSfbnqFgDAX_Ni0knl7o&callback=loadMap">
</script>


<script>

    $('#signupForm').submit(function(event){
        event.preventDefault();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        var address = $('#address').val();
        var event_name = $('#event-name').val();
        var description = $('#description').val();
        var start_time = $('#start-time').val();
        var end_time = $('#end-time').val();
        var category = $('#category').val();
        $.ajax({
            type: "POST",
            url: "locations_model.php",
            data: {
              //Assigning values into variables.
               event_name: event_name,
               description: description,
               Latitude: lat,
               Longitude: lng,
               Address: address,
               start_time: start_time,
               end_time: end_time,
               category: category,
               Add_Event: 1
            },
            success: function(data){
                alert(data);
                location.reload();
            }
        });
    });



</script>



<?php
include_once 'footer.php';

?>
