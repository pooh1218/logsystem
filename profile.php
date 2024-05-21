<?php

session_start();
require_once "config.php";
if(!isset($_SESSION["loggedin"])){
    echo "<script>" . "window.location.href='./login.php';" . "</script>";
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Profile Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php include "navbar.php"?>
        <div class="container">
            <div class="row">
            <div class="col-md-6 ">
            <ul class="list-group">
            <li class="list-group-item active">Account Info</li>
            <li class="list-group-item">Username: <?php echo $_SESSION["username"]?></li>
            <li class="list-group-item">Email: <?php echo $_SESSION["email"]?></li>
            <!-- <li class="list-group-item">Date of Registration: <?php echo $_SESSION["reg_date"]?></li> -->
            <!-- <li class="list-group-item">Authority: <?php echo $usersinfo["authority"]?></li> -->
            </ul>
            </div>
            </div>
        </div>
    </body>
</html>