<?php

if(DEVELOPER)
{
	$username = 'root';
	$password = '';
	$hostname = 'localhost';
	$database = 'tiendita';
}
else
{
	$username = 'unifica_usr';
	$password = 'Un1Fic61025110';
	$hostname = 'localhost';
	$database = 'unifica';
}

$dbLink= mysqli_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");

$selected = mysqli_select_db($dbLink,$database) or die("Could not select $database");
mysqli_query($dbLink,"SET NAMES UTF8");