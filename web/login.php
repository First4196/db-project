<?php
require_once('common.php');
if(isset($_SESSION["account_username"])){
  if($_SESSION['account_type']=='student')$to='dashboard_student.php';
  else if($_SESSION['account_type']=='professor')$to='dashboard_professor.php';
  else $to='dashboard_staff.php';
  header('Location: '.$to);
  die;
}
$title='Welcome to Reg Chula++';
require_once('header.php');
?>
<link rel="stylesheet" href="res/signin.css">
<div class="text-center w-100">
  <form class="form-signin" action="doLogin.php" method="POST">
    <img src="/img/logo.png" alt="logo" width="150" height="150">
    <h1 class="h5 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputUsername" class="sr-only">Username</label>
    <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-block" type="submit" style="background:#f167ab;color:white;">Sign in</button>
    <button class="btn btn-lg btn-block" onclick="window.location='index.php';">Back</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2018-2018</p>
  </form>
</div>
    
<?php
require_once('footer.php');