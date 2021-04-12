<?php
if (  isset($_SESSION["admin"]) and  $_SESSION["admin"] == 0 )
{
    header("location:sales.php");
}

