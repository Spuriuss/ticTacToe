<?php
include('extensions/db.php');


$username = $_POST['username'];

$request = "SELECT * FROM users WHERE username='$username'";
$response = mysqli_query($connection, $request) or die(mysqli_error($connection));
$thisUser = mysqli_fetch_assoc($response);

if (isset($thisUser)) {
	if ($thisUser['online'] == 'no') {
		
		$thisUserID = $thisUser['id'];
		
		$request = "SELECT * FROM users WHERE id<>'$thisUserID'";
		$response = mysqli_query($connection, $request) or die(mysqli_error($connection));
		$otherUser = mysqli_fetch_assoc($response);
		
		if ($otherUser['online'] == 'yes') {
			if ($otherUser['playing'] == 'crosses') {
				$youArePlaying = 'nulls';
				$turn = 'no';
			}
			if ($otherUser['playing'] == 'nulls') {
				$youArePlaying = 'crosses';
				$turn = 'yes';
			}
		} else {
			$coinToss = rand(1,2);
			if ($coinToss == 1) {
				$youArePlaying = 'crosses';
				$turn = true;
			} else {
				$youArePlaying = 'nulls';
				$turn = false;
			}
		}
		
		$request = "UPDATE users SET online='yes', playing='$youArePlaying', turn='$turn' WHERE username='$username'";
		mysqli_query($connection, $request) or die(mysqli_error($connection));
		
		setcookie('id', $thisUser['id'], time() + (365 * 24 * 60 * 60), '/');
		
		echo 'loggedIn';
	} else {
		echo 'userAlreadyOnline';
	}
} else {
	echo 'wrongName';
}
?>