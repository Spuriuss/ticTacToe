<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'tictactoe';
$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$connection->set_charset("utf8");	
?>