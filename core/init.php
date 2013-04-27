<?php

//Include this file everywhere
session_start();
error_reporting(0);// turning of errors on the page
require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/students.php';
require 'functions/teachers.php';


//seperate functions
//require 'functions/function.resize.php';

$current_file = explode('/',$_SERVER['SCRIPT_NAME']);
$current_file = end($current_file);

if(studentLogged_in() === true)
{
	$session_user_id = $_SESSION['S_ID'];
	$student_data = student_data($session_user_id,'S_ID','username','password','password_recover','firstname','lastname','phonenumber','email');
	
	
	if(is_null($dbtable_name) === false)
	{   
			
	    if(user_active($dbtable_name,$user_data['username']) === false)//check for banned users
		{
			print_r("Session Being Destroyed");
			session_destroy();
			header('Location: index.php');
			exit();
		}
	}
	//if($current_file !== 'changepassword.php' && $current_file !== 'logout.php' && $student_data['password_recover'] == 1)
	//{

	  // echo '<META HTTP-EQUIV="Refresh" Content="0; URL= change-password.php">';
	   //exit();

	//}
}
if(teacherLogged_in() === true)
{
	$session_user_id = $_SESSION['T_ID'];
	$teacher_data = teacher_data($session_user_id,'T_ID','username','prefix','firstname','lastname','email','C_ID','password','profile');
	
}
$errors = array();
$dbtable_name = NULL;
$currentTeacher = NULL;

?>