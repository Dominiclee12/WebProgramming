<?php
session_start();
if(!isset($_SESSION['username'])) {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Changing Your Password</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
    .bs-example{
      margin: 20px;        
    }

    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
      margin-left: auto;
      margin-right: auto;
      height: 300px;
      width: 600px;
    }

    .container {
      padding: 16px;
    }

    .center {
      margin: auto;
      margin-top: 50px;
      padding: 10px;
    }
  </style>

</head>
<body>
  <div class="container center">
   <div class="form-group" style="margin-bottom: 50px;">
    <h1>Change Your Password</h1>
  </div>
  <form action="passverification.php" method="post">
    <div class="form-group row">
      <label for="inputPassword1" class="col-sm-2 col-form-label">Old Password</label>
      <div class="col-sm-10">
        <input type="password" name="opassword" class="form-control" id="inputPassword1" placeholder="Old Password" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword2" class="col-sm-2 col-form-label">New Password</label>
      <div class="col-sm-10">
        <input type="password" name="npassword" class="form-control" id="inputPassword2" placeholder="New Password" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
      <div class="col-sm-10">
        <input type="password" name="cpassword" class="form-control" id="inputPassword3" placeholder="Confirm Password" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10 offset-sm-2">
        <button type="submit" class="btn btn-primary" name="submit">Change</button>
        <a type="button" class="btn btn-secondary" style="float: right;" href="home.php">Return Home</a>
      </div>
    </div>
  </form>
</div>
</body>
</html>