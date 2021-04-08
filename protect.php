<?php
session_start();
if ( ! isset($_SESSION["logged_in"]))
{
  header("location:login.php");
}
//checking if the session does not exist, take the user to the login page