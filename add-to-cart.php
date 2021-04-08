<?php
if (isset($_GET["id"]))
{
    session_start();
    $_SESSION["products"][] = $_GET["id"];
}
header("location:sales.php");
