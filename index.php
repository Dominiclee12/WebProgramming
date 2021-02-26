<?php
session_start();
if(isset($_GET['exit'])) {
    if($_GET['exit']=='logout'){
        session_unset();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mobility Care Login</title>
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
          width: 700px;
      }

      .container {
          padding: 16px;
      }
  </style>

</head>
<body>
    <div class="container">
        <div class="imgcontainer">
            <img src="logo1.png" alt="Static Cow" height="100%" width="100%" class="center center no-repeat">
        </div>
        <form action="verification.php" method="post">
            <div class="form-group row">
                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="inputTextBox" name="username" class="form-control" id="inputUsername" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <label class="form-check-label"><input type="checkbox"> Remember me</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>