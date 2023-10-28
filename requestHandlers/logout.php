<?php
include('extensions/db.php');

$userID = $_COOKIE['id'];



$request = "UPDATE users SET online='no' WHERE id='$userID'";
mysqli_query($connection, $request) or die(mysqli_error($connection));


setcookie('id', '', time() - 1, '/');


header('Location: ../index.php');
?>