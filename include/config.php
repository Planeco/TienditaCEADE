<?php
/*
* This is a PHP Secure login system.
* Copyright (c) 2011 PHP Secure login system -- http://www.php-developer.org
* AUTHORS:
* Codex-m
* Refer to license.txt to how code snippets from other authors or sources are attributed.
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*/
//require user configuration and database connection parameters
///////////////////////////////////////
//START OF USER CONFIGURATION/////////
/////////////////////////////////////
//Define MySQL database parameters
 
$username = 'root';
$password = '';
$hostname = 'localhost';
$database = 'ceade';
 
//Define your canonical domain including trailing slash!, example:
$domain = "http://localhost/oms_servidor/oms/";
 
//Define sending email notification to webmaster
 
$email = 'webmaster@oms.focim.com.mx';
$subject = 'Nuevo Usuario en CEADE HD';
$from = 'From: Focim noreplay';
 
//Define Recaptcha parameters
$privatekey = "6Lc9LRYTAAAAADer0SLbP0uCLp6aFq8uRwZlFmnE";
$publickey = "6Lc9LRYTAAAAAE-2ApMYFCa6eNVZSfnWmX_3zO45";
 
//Define length of salt,minimum=10, maximum=35
$length_salt = 15;
 
//Define the maximum number of failed attempts to ban brute force attackers
//minimum is 5
$maxfailedattempt = 7;
 
//Define session timeout in seconds
//minimum 60 (for one minute)
$sessiontimeout = 1500;
 
////////////////////////////////////
//END OF USER CONFIGURATION/////////
////////////////////////////////////
//DO NOT EDIT ANYTHING BELOW!
$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");

$selected = mysql_select_db($database, $dbhandle)
or die("Could not select $database");
mysql_set_charset('utf8');
$loginpage_url = $domain;
$forbidden_url = $domain . '/forbidden.php';
?>