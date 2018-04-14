<?php
require_once('common.php');
if(isset($_POST['ARGV'])){
  foreach ($_POST['ARGV'] as $key => $value){
    $_POST['ARGV'][$key] = "'".$_POST['ARGV'][$key]."'";
  }
}
else{
  $_POST['ARGV']=array();
}

$result = mysqli_query($db,"CALL ".$_POST['WHAT']."(".implode(',',$_POST['ARGV']).")");

if(is_bool($result)) {
  die(json_encode($result));
}

$arr = array();
while ($row = $result->fetch_array()) 
{
  $arr[] = $row;
}
echo json_encode($arr);