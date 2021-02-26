<?php
session_start();
$o=md5($_POST['opassword']);//old password
$n=md5($_POST['npassword']);//new password 
$c=md5($_POST['cpassword']);//confirm password 

$con=mysqli_connect("lrgs.ftsm.ukm.my","a170586","biggraygoat","a170586");//mysqli("localhost","username of database","password of database","database name")

$psql = "UPDATE tbl_staffs_a170586_pt2 SET fld_staff_password='".$n."' WHERE fld_staff_username='".$_SESSION['username']."'";
if(mysqli_query($con, $psql) && $_SESSION['password'] == $o && $n == $c)
{
  echo "Password changed successful";
  $_SESSION['password'] = $n;
  header("refresh:1;url=home.php");
}
else
{
  echo "Failed to change password";
  header("refresh:1;url=change_password.php");// it takes 2 sec to go index page
}


?>