<?php
include ('config.php');


// initializing variables
$username = "";
$email    = "";
$errors = NULL;

// connect to the database
$db = mysqli_connect ($host, $user, $pass, $dbName);

// REGISTER USER
if (isset($_POST['register-submit'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
  $password_2 = mysqli_real_escape_string($db, $_POST['psw-repeat']);
  $accountid = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { $errors = "Username is required. "; }
  if (empty($email)) { $errors .= "Email is required. "; }
  if (empty($password_1)) { $errors .= "Password is required. "; }
  if ($password_1 != $password_2) {
	   $errors .= "The two passwords do not match. ";
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM ACCOUNTS WHERE username='$username' OR email='$email' OR accountid='$accountid' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      $errors .= "Username already exists. ";
    }

    if ($user['email'] === $email) {
      $errors .= "Email already exists. ";
    }

    if ($user['accountid'] === $accountid) {
      $errors .= "email already exists";
    }

  }
  $_SESSION['error'] = $errors;
  // Finally, register user if there are no errors in the form
  if (is_null($errors)) {
  	$password = md5($password_1);//encrypt the password before saving in the database
  	$query = "INSERT INTO ACCOUNTS (username, email, accountid, password)
  			  VALUES('$username', '$email', '$accountid', '$password')";
  	mysqli_query($db, $query);
    $_SESSION['success'] = "Registeration successful. Now you can login, " . $username;
  }
}
echo '<script>';
echo 'window.location.href="Main.php"';
echo '</script>';


?>
