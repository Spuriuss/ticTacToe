<?php
include('extensions/db.php');

$field = $_POST['field'];
$gameOver = $_POST['gameOver'];

$request = "UPDATE field SET field='$field', changed='yes' WHERE n=1";
mysqli_query($connection, $request) or die(mysqli_error($connection));


$request = "UPDATE users SET turn = NOT turn";
mysqli_query($connection, $request) or die(mysqli_error($connection));

if ($gameOver == 'yes') {
	$request = "UPDATE users SET wins=wins+1 WHERE turn=0";
	mysqli_query($connection, $request) or die(mysqli_error($connection));	
	
	$request = "UPDATE users SET losses=losses+1, turn=0 WHERE turn=1";
	mysqli_query($connection, $request) or die(mysqli_error($connection));
}
?>