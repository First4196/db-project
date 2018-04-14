<?php
require_once('common.php');
//echo "SELECT * FROM account where username=".$_POST["username"]." and password=".$_POST["password"];
$result=mysqli_query($db,"SELECT * FROM account where username='".$_POST["username"]."' and password='".$_POST["password"]."'");
//$result=mysqli_query($db,"SELECT * FROM account");
if($row = $result->fetch_array()){
  $_SESSION['account_username'] = $row['username'];
  $_SESSION['account_type'] = $row['type'];
}

header('Location: login.php');
?>