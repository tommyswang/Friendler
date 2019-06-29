<?php
include("config.php");
// Gets data from URL parameters.
if(isset($_POST['Add_Event']) && isset($_SESSION['email'])) {
    add_location();
}


function add_location(){
    $connection=mysqli_connect ($host, $user, $pass, $dbName);
    if (!$connection) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $event_name = $_POST['event_name'];
    $lat = $_POST['Latitude'];
    $lng = $_POST['Longitude'];
    $address = $_POST['Address'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $classification = $_POST['category'];
    $description = $_POST['description'];
    $event_host = $_SESSION['username'];
    $new_id;
    // Inserts new row with place data.
    $query1 = sprintf("INSERT INTO Events " .
        " (Event, Event_Description_Agenda, Latitude, Longitude, Start_time, End_time, Classification, Host, Address) " .
        " VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
        mysqli_real_escape_string($connection,$event_name),
        mysqli_real_escape_string($connection,$description),
        mysqli_real_escape_string($connection,$lat),
        mysqli_real_escape_string($connection,$lng),
        mysqli_real_escape_string($connection,$start_time),
        mysqli_real_escape_string($connection,$end_time),
        mysqli_real_escape_string($connection,$classification),
        mysqli_real_escape_string($connection,$event_host),
        mysqli_real_escape_string($connection,$address));
    $result1 = mysqli_query($connection,$query1);

    $query2 = "SELECT id FROM Events ORDER BY id DESC LIMIT 1";
    $result2 = mysqli_query($connection,$query2);
    /* fetch associative array */
    while ($row = $result2->fetch_assoc()) {
      $new_id = $row["id"];
    }

    $query3 = "INSERT INTO UserAttending (username, eventid, eventname)
  			  VALUES('$event_host', '$new_id', '$event_name')";
  	mysqli_query($connection, $query3);
    echo json_encode("Inserted Successfully");
    if (!$result1) {
        die('Invalid query: ' . mysqli_error($connection));
    }

}
function get_saved_locations(){
    $connection=mysqli_connect ($host, $user, $pass, $dbName);
    if (!$connection) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($connection,"SELECT Longitude, Latitude FROM Events ");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
    $indexed = array_map('array_values', $rows);

    //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}

?>
