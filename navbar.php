<?php
session_start();
include ('config.php');
?>

<html lang="en">
<head>
  <title>Friendler</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<style>
  * {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
  }
  html, body {
      height:100%;
      width:100%;
      overflow: hidden;
      margin: 0;
      padding: 0;
  }
  body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: white;
  }
  .navbar {
    height: 7vh;
  }
  .dropdown-menu {
    padding: 0;
  }
  .dropdown-menu a:hover {
    border-radius: 10%;
  }
  .dropdown-toggle {
    color: rgba(255,255,255,.5);
  }
  .dropdown-toggle:hover {
    color: rgba(255,255,255,.8);
  }

  .img {
  background-color: #fff;
  width: 50px;
  height: 50px;
  display: block;
  }
  a:hover {
    cursor: pointer;
  }
 a.dropdown-toggle:focus {
    color: white;
  }
  #top-div h5 {
    font-weight: bold;
  }
  #display {
    position: fixed;
    background-color: white;
    border-bottom: 1px solid #DFE0E5;
    box-shadow: 0 5px 5px -3px #DFE0E5;
    width: 250px;
  }
  #display ul{
    list-style-type: none;
    padding-left: 13px;
    padding-bottom: 6px;
  }

  .error {
    border-color: #ff0000 !important;
    box-shadow: 0px 1.5px rgba(255, 0, 0, 0.8) !important;
  }
  .success {
    border-color: #4BB543 !important;
    box-shadow: 0px 1.5px rgba(75, 181, 67, 0.8) !important;
  }

  .sm-hover-transition {
    color: gray;
    font-size: 15px;
    transition: font-size 1s ease-in-out;
  }
  .sm-hover-transition:hover {
    color: #17A2B8;
    font-size: 16px;
  }

  #wrapper {
      height: 100%;
  }
  #left-div {
      float: left;
      width: 25%;
      height: 100%;
      border-right: 1px solid #DFE0E5;
      overflow: auto;
      padding-bottom: 100px;
  }
  #right-div {
      position: relative;
      float: left;
      width: 75%;
      height: 93vh;
      overflow: auto;
      padding-bottom: 50px;
  }

  #right-div .container {
    width: 100%;
    padding: 0;
  }

  #left-div .container {
    margin-top: 15px;
    width: 100%;
  }

  #signupForm {
    width: 100%;
  }


  #event-header-name {
    margin-top: 0;
  }

  a {
    text-decoration: none !important;
    color: black;
  }


  input[type=text], select, input[type=datetime-local] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
  }

  input[type=submit] {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
  }

  input[type=submit]:hover {
      background-color: #45a049;
  }

  #category {
    height:48px;
    background-color: white;
  }

  #map {
    width: 100%;
    height: 93vh;
  }
  #data, #allData {
    display: none;
  }
  .form-title {
    font-variant: small-caps;
  }
  .text-btn {
      color: #17A2B8;
      font-size: 14px;
      font-weight: bold;
      text-decoration: none;
  }
  .text-btn:hover {
    color: #157c8c;
  }
  .event-name {
    font-weight: bold;
    font-size: 16px;
  }
  #dropbtn {
    display: inline-block;
    text-decoration: none;
    color: #668ad8;
    width: 40px;
    height: 40px;
    margin-top: 5px;
    line-height: 30px;
    border-radius: 50%;
    border: double 3px #668ad8;
    text-align: center;
    vertical-align: middle;
    overflow: hidden;
    transition: .8s;
  }

  #dropbtn:hover{
    -webkit-transform: rotateY(360deg);
    -ms-transform: rotateY(360deg);
    transform: rotateY(360deg);
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content a {
    color: black;
    padding: 12px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {background-color: #f1f1f1;}

  .dropdown:hover .dropdown-content {
    display: block;
  }



/* ------------------------------------------------------------ */

.dropbtn {
  color: white;
  font-size: 16px;
  border: none;
  cursor: pointer;
}


.dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: #f9f9f9;
  min-width: 60px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
  z-index: 10000005;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.fa-times {
  -webkit-transition: -webkit-transform .5s ease-in-out;
          transition:         transform .5s ease-in-out;
}

.fa-times:hover {
  color: #157c8c;
  -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
}
@media only screen and (max-width: 1150px) {
  #left-div {
      width: 35%;
  }
  #right-div {
      width: 65%;

  }
}
</style>

<body>


  <nav class="navbar navbar-expand-md navbar-dark bg-info">
      <a href="Main.php" class="navbar-brand">Friendler</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCustom">
          <i class="fa fa-bars fa-lg py-1 text-white"></i>
      </button>
      <div class="navbar-collapse collapse" id="navbarCustom">
          <ul class="navbar-nav mr-auto">
              <!-- <li class="nav-item active">
                  <a class="nav-link" href="#">Active</a>
              </li> -->

                  <a class="nav-link" href="visualization.php"><i class="far fa-chart-bar"></i>  Visualization</a>
                  <a class="nav-link" href="all_events.php"><i class="far fa-calendar-alt"></i>  All Events</a>
                  <a class="nav-link" href="all_users.php"><i class="fas fa-users"></i>  All Users</a>

          </ul>
          <ul class="navbar-nav">

            <?php
                if (!isset( $_SESSION["username"])) {
                  echo' <li class="dropdown order-1">
                          <button type="button" id="dropdownMenu2" data-toggle="dropdown" class="btn btn-outline-info dropdown-toggle"><i class="far fa-user"></i>  Sign Up <span class="caret"></span></button>
                              <ul class="dropdown-menu dropdown-menu-right mt-2">
                                 <li class="px-3 py-2" style="width: 300px; margin-top: 15px;">
                                     <p class="form-title">Sign Up</p>
                                     <p>Please fill in this form to create an account.</p>
                                     <form class="form" role="form" method="post" action="register.php">
                                          <div class="form-group">
                                              <input placeholder="Username" class="form-control form-control-sm" name="username" required autofocus>
                                          </div>
                                          <div class="form-group">
                                              <input placeholder="Email" class="form-control form-control-sm" type="email" name="email" required>
                                          </div>
                                          <div class="form-group">
                                              <input placeholder="Password" class="form-control form-control-sm" type="password" name="psw" required>
                                          </div>
                                          <div class="form-group">
                                              <input placeholder="Enter Password Again" class="form-control form-control-sm" type="password" name="psw-repeat" required>
                                          </div>
                                          <div class="form-group">
                                              <button type="submit" class="btn btn-info btn-block" name="register-submit">Register</button>
                                          </div>
                                      </form>
                                  </li>
                              </ul>
                          </li>';
                  echo' <li class="dropdown order-1">
                          <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-info dropdown-toggle"><i class="fas fa-sign-in-alt"></i>  Login <span class="caret"></span></button>
                              <ul class="dropdown-menu dropdown-menu-right mt-2">
                                 <li class="px-3 py-2" style="width: 250px; margin-top: 15px;">
                                     <p class="form-title">Login</p>
                                     <form class="form" role="form" method="post" action="login.php">
                                          <div class="form-group">
                                              <input id="email" placeholder="Email" class="form-control form-control-sm" type="email" name="email" required autofocus>
                                          </div>
                                          <div class="form-group">
                                              <input id="psw" placeholder="Password" class="form-control form-control-sm" type="password" name="psw" required>
                                          </div>
                                          <div class="form-group">
                                              <button type="submit" class="btn btn-info btn-block" name="login-submit">Login</button>
                                          </div>
                                      </form>
                                  </li>
                              </ul>
                          </li>';
                } else {
                  $firstCharacter = substr($_SESSION["username"], 0, 1);
                  echo' <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="far fa-user"></i>  Profile
                            </a>
                            <div class="dropdown-menu" style="right: 0; left: auto;"aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="pointer-events: none;">Hi! '.$_SESSION["username"].'</a>
                                <hr style="margin:0;">
                                <a class="dropdown-item" href="user_profile.php?username='.$_SESSION["username"].'">My Events</a>
                                <a class="dropdown-item" href="friends_list.php?username='.$_SESSION["username"].'">My Friends</a>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>';
                }
            ?>

          </ul>


      </div>
  </nav>
  <?php
  if(!empty($_SESSION['success'])) {
     echo '<div class="alert alert-success alert-dismissible" style="position:absolute; width: 100%; z-index:1000000;">
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>'.$_SESSION['success'].'</strong>
          </div>';
     // Unset session message so that it only appears once
     unset($_SESSION['success']);
  }
  if(!empty($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible" style="position:absolute; width: 100%; z-index:1000000;">
                <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>'.$_SESSION['error'].'</strong>
              </div>';
    unset($_SESSION['error']);
  }
   ?>
