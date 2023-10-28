<?php
if (isset($_COOKIE['id'])) {
	header('Location: play.php');
}
?>



<html>
<head>
<script type='text/javascript' src='js/extensions/jquery-3.4.1.js'></script>

<link rel=stylesheet type=text/css href=<?php echo "'css/a.css?version=", rand(), "'"; ?> />
<link rel=stylesheet type=text/css href=<?php echo "'css/index.css?version=", rand(), "'"; ?> />

<title> Крестики-нолики </title>
</head>



<body>
<div id=main>
	<input id=username placeholder='имя пользователя' /><br>
	
	<div class=button id=loginButton>
		<div class=centerText> Войти </div>
		<div class=loadingAnimation></div>
	</div>
</div>
</body>

<script type='text/javascript' src=<?php echo "'js/extensions/a.js?version=", rand(), "'"; ?>></script>
<script type='text/javascript' src=<?php echo "'js/index.js?version=", rand(), "'"; ?>></script>
</html>