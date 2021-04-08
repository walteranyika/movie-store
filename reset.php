<?php
$password =  password_hash("123456", PASSWORD_BCRYPT);
$sql = "update users set password= '$password' where 1";
include 'connect.php';
mysqli_query($con, $sql) or die(mysqli_error($con));
