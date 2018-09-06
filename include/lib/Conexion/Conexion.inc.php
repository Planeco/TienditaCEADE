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
	$username = 'root';
	$password = 'Ge2016RTF*vbT';
	$hostname = 'localhost';
	$database = 'tiendita';
}

$dbLink= mysqli_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");

$selected = mysqli_select_db($dbLink,$database) or die("Could not select $database");
mysqli_query($dbLink,"SET NAMES UTF8");