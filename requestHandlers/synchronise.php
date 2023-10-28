<?php
include('extensions/db.php');


$userID = $_POST['userID'];

$request = "SELECT * FROM users WHERE id='$userID'";
$response = mysqli_query($connection, $request) or die(mysqli_error($connection));
$user = mysqli_fetch_assoc($response);
$turn = $user['turn'];
$wins = $user['wins'];
$losses = $user['losses'];

$request = "SELECT * FROM field WHERE n=1";
$response = mysqli_query($connection, $request) or die(mysqli_error($connection));
$fieldLine = mysqli_fetch_assoc($response);
$field = $fieldLine['field'];


$sendBack = 
'field=' . $field . '&' . 
'turn=' . $turn . '&' . 
'wins=' . $wins . '&' . 
'losses=' . $losses;

echo $sendBack;
?>