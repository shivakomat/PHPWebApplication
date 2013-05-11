<?php
	
	//local host settings
	//$host  		= 'locahost';	$username 	= 'root'; 	$password 	= 'password';  $db = 'lionsoft_parentteacher';

	//external host settings
	//$host  		= 'db463998569.db.1and1.com'; 	$username 	= 'dbo463998569'; 	$password 	= 'hyderabad' $db = 'db463998569';

    $connect_error='Sorry We\'re experiemcing connection problems';

    //local server settings
	$connect = mysql_connect('localhost','root','password')or die($connect_error);	
	mysql_select_db('lionsoft_parentteacher');

    //online server settings 
	//$connect = mysql_connect('db463998569.db.1and1.com','dbo463998569','hyderabad') or die($connect_error);
	//mysql_select_db('db463998569');
	
?>
 