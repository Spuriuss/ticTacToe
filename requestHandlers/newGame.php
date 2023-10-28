<?php
include('extensions/db.php');


$request = "UPDATE field SET field='' WHERE n=1";
mysqli_query($connection, $request) or die(mysqli_error($connection));


$request = "UPDATE users SET turn=1 WHERE playing='crosses'";
mysqli_query($connection, $request) or die(mysqli_error($connection));
?>