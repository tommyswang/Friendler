<?php
include ('config.php');

// login form is submitted
if(isset($_POST['login-submit'])) {
  // Get form data after submission
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $pass = mysqli_real_escape_string($connection, $_POST['psw']);
  $password = md5($pass);
  $query = "SELECT * FROM ACCOUNTS WHERE email = '$email'";
  $results = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($results);
  $check_pass = $row['password'];
  if (empty($email)) {
    $errors = "Username is required. ";
  }
  if (empty($pass)) {
    $errors .= "Password is required. ";
  }
  if ($password != $check_pass) {
    $errors .= "Incorrect Email or Password. ";
  }
  $_SESSION['error'] = $errors;
  if (is_null($errors)) {
    if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['email'] = $email;
      $_SESSION['username'] = $row['username'];
      $_SESSION['success'] = "Welcome back " . $row['username'];
  	}
  }


}
echo '<script>';
echo 'window.location.href="Main.php"';
echo '</script>';

?>


  <script>
    // Trigger form submit on enter key
    window.addEventListener("keyup", function(event) {
      if (event.keyCode === 13) {
       event.preventDefault();
       document.getElementById("form-submit").click();
      }
    });
  </script>
