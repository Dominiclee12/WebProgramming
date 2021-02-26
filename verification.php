<?php
session_start();
$u=$_POST['username'];//username
$p=md5($_POST['password']);//password 

$con=mysqli_connect("lrgs.ftsm.ukm.my","a170586","biggraygoat","a170586");//mysqli("localhost","username of database","password of database","database name")
$result=mysqli_query($con,"SELECT * FROM `tbl_staffs_a170586_pt2` WHERE `fld_staff_username`='$u' && `fld_staff_password`='$p'");
$count=mysqli_num_rows($result);


if($count==1)
{
  echo "Login Successful";
  $_SESSION['password'] = $p;
  /* fetch associative array */
  while($row = mysqli_fetch_assoc($result)) {
    $_SESSION['level'] = $row["fld_staff_userlevel"];
    $_SESSION['username'] = $row["fld_staff_username"];
  }

  header("refresh:1;url=home.php");

}
else
{
  echo "Login Failed";
  header("refresh:1;url=index.php");// it takes 2 sec to go index page
}


?>