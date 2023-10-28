<?php
include('requestHandlers/extensions/db.php');
include('requestHandlers/extensions/functions.php');

if (!isset($_COOKIE['id'])) {
	header('Location: index.php');
} else {
	$userID = $_COOKIE['id'];
	
	$request = "SELECT * FROM users WHERE id='$userID'";
	$response = mysqli_query($connection, $request) or die(mysqli_error($connection));
	$user = mysqli_fetch_assoc($response);
}
?>



<html>
<head>
<script type='text/javascript' src='js/extensions/jquery-3.4.1.js'></script>

<link rel=stylesheet type=text/css href=<?php echo "'css/a.css?version=", rand(), "'"; ?> />
<link rel=stylesheet type=text/css href=<?php echo "'css/play.css?version=", rand(), "'"; ?> />


<script>
	userID = <?php echo "'", $user['id'], "'"; ?>;
	youArePlaying = <?php echo "'", $user['playing'], "'"; ?>;
	yourTurn = <?php echo "'", $user['turn'], "'"; ?>;
</script>

<title> Крестики-нолики </title>
</head>



<body>
<div id=userName>
	<?php echo $user['username']; ?>
</div>
<div id=wins>
	Победы - <span class=targetText><?php echo $user['wins']; ?></span>
</div>
<div id=losses>
	Поражения - <span class=targetText><?php echo $user['losses']; ?></span>
</div>
<div class=button id=newGameButton>
	<div class=centerText> Новая игра </div>
</div>
<a href='requestHandlers/logout.php' id=logoutButton>
	<img src='images/logoutIcon.png' />
</a>

<div id=field>
	<?php
	$request = "SELECT * FROM field WHERE n=1";
	$response = mysqli_query($connection, $request) or die(mysqli_error($connection));
	$fieldLine = mysqli_fetch_assoc($response);
	$field = base64_decode($fieldLine['field']);
	if ($field == '') {
		$field = spawnField(5);
		$fieldEncoded = base64_encode($field);
		$request = "UPDATE field SET field='$fieldEncoded' WHERE n=1";
		mysqli_query($connection, $request) or die(mysqli_error($connection));
	}

	
	echo $field;
	?>
</div>
</body>


<script type='text/javascript' src=<?php echo "'js/extensions/a.js?version=", rand(), "'"; ?>></script>
<script type='text/javascript' src=<?php echo "'js/extensions/functions.js?version=", rand(), "'"; ?>></script>
<script type='text/javascript' src=<?php echo "'js/play.js?version=", rand(), "'"; ?>></script>
</html>