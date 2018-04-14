<!DOCTYPE html5>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
  <script src="res/util.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="navbar-nav mr-auto">
        <a class="navbar-brand" href="index.php">
          <img src="/img/logo.png" width="30" height="30" alt="">
        </a>
<?php 
if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] == "student"){
?>
      <a class="nav-item nav-link" href="login.php">Dashboard</a>
      <a class="nav-item nav-link" href="student_info.php">My info</a>
      <a class="nav-item nav-link" href="student_registration.php">Registration</a>
      <a class="nav-item nav-link" href="student_course.php">My course</a>
      <a class="nav-item nav-link" href="student_grade.php">Grade</a>
      <a class="nav-item nav-link" href="student_request.php">Request</a>
      
<?php
}

if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] == "professor"){
?>
      <a class="nav-item nav-link" href="login.php">Dashboard</a>
      <a class="nav-item nav-link" href="#">Course</a>
      <a class="nav-item nav-link" href="#">Student</a>
      <a class="nav-item nav-link" href="#">Information</a>
<?php
}
 
if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] == "staff"){
?>
      <a class="nav-item nav-link" href="login.php">Dashboard</a>
      <a class="nav-item nav-link" href="#">Request</a>
      <a class="nav-item nav-link" href="staff_account.php">Account Management</a>
      <a class="nav-item nav-link" href="#">Student Management</a>
      <a class="nav-item nav-link" href="#">Course Management</a>
      
<?php
}

if(!isset($_SESSION["account_type"])){
?>
      <a class="nav-item nav-link" href="#">Information</a>
<?php
}
?>
      </div>
      <div class="navbar-nav ml-auto">
<?php
if(isset($_SESSION["account_type"])) {
?>
        <span class="navbar-text text-white"><?php echo $_SESSION["account_username"]; ?></span>
        <a class="nav-item nav-link" href="doLogout.php">Logout</a>
<?php
}
else {
?>
        <a class="nav-item nav-link" href="login.php">Login</a>
<?php
}
?>
      </div>
    </nav>