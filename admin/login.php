<?php
session_start();
if(isset($_SESSION['sno']))
{
    $_SESSION['status'] = "You are already logged In";
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
     integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 pt-4">
                <form action="lib/actions.php?query=submit" method="post">
                    <center><h1>Login Form</h1></center>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <button type="submit" name="loginbtn" class="btn btn-primary">Submit</button>
                    <!-- <a href="register.php" class="btn btn-dark">register</a> -->
                </form>
            </div>
        </div>
    </div>
    <?php
    include 'parts/scripts.php';
    ?>
</body>
</html>