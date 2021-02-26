<?php
session_start();
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a170586_pt2(fld_staff_num, fld_staff_fname, fld_staff_lname,
      fld_staff_gender, fld_staff_phone, fld_staff_address, fld_staff_email, fld_staff_username, fld_staff_password, fld_staff_userlevel) 
      VALUES(:sid, :fname, :lname, :gender, :phone, :address, :email, :username, :password, :userlevel)");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':username', $susername, PDO::PARAM_STR);
    $stmt->bindParam(':password', $spassword, PDO::PARAM_STR);
    $stmt->bindParam(':userlevel', $userlevel, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender =  $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $susername = $_POST['susername'];
    $spassword = md5($_POST['spassword']);
    $userlevel = $_POST['ulevel'];
         
    if($_SESSION['level'] == 3) {
      $stmt->execute();
    } else {
      ?><script>window.alert("You do not have the right to do this")</script><?php
    }
    
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_staffs_a170586_pt2 SET fld_staff_num = :sid, fld_staff_fname = :fname, fld_staff_lname = :lname, fld_staff_gender = :gender,
      fld_staff_phone = :phone, fld_staff_address = :address, fld_staff_email = :email, fld_staff_username = :username, fld_staff_password = :password, fld_staff_userlevel = :userlevel
      WHERE fld_staff_num = :oldsid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':username', $susername, PDO::PARAM_STR);
    $stmt->bindParam(':password', $spassword, PDO::PARAM_STR);
    $stmt->bindParam(':userlevel', $userlevel, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $susername = $_POST['susername'];
    $spassword = md5($_POST['spassword']);
    $userlevel = $_POST['ulevel'];
    $oldsid = $_POST['oldsid'];
         
    if($_SESSION['level'] == 2 || $_SESSION['level'] == 3) {
      $stmt->execute();
      header("Location: staffs.php");
    } else {
      ?><script>window.alert("You do not have the right to do this")</script><?php
    }
 
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a170586_pt2 where fld_staff_num = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['delete'];
     
    if($_SESSION['level'] == 3) {
      $stmt->execute();
      header("Location: staffs.php");
    } else {
      ?><script>window.alert("You do not have the right to do this")</script><?php
    }
 
    
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a170586_pt2 where fld_staff_num = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
 
?>