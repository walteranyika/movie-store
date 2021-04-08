<?php
include 'protect.php';

if ( isset($_REQUEST["password"]) )
{
    $names = $_REQUEST["names"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $password = password_hash($password, PASSWORD_BCRYPT);
    //$con = mysqli_connect("localhost", "root", "root", "supermarket") or die(mysqli_connect_error());
    require 'connect.php';
    $sql = "INSERT INTO `users`(`id`, `names`, `email`, `password`) VALUES (null,'$names','$email','$password')";
    mysqli_query($con, $sql) or die(mysqli_error($con));
    header("location:add-user.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'nav.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <h4>New User</h4>
            <form action="add-user.php" method="post">

                <div class="form-group">
                    <label>Names</label>
                    <input type="text" class="form-control" name="names" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <button class="btn btn-success">Add User</button>


            </form>
        </div>
    </div>
</div>



</body>
</html>
