<?php
function change_profile_image($teacher_id,$file_temp,$file_extn)
{
	$image = new SimpleImage();
	$image->load($file_temp);
	$image->resizeToWidth(389);
	$image->save($file_temp);

	$file_path 			 = 'images/profile/'.substr(md5(time()),0,10).'.'.$file_extn;
	move_uploaded_file($file_temp, $file_path);	
	mysql_query("UPDATE `teachers` SET `profile` = '$file_path' WHERE `T_ID` = $teacher_id") or die("couldnt store image on database");

}

function activate_teacher($email,$emailcode)
{
	$email = mysql_real_escape_string($email);
	$emailcode = mysql_real_escape_string($emailcode);

	if(mysql_result(mysql_query("SELECT COUNT(`T_ID`) FROM `teachers` WHERE `email` = '$email' AND `emailcode` = '$emailcode' AND `active` = 0"), 0) == 1)
	{
		mysql_query("UPDATE `teachers` SET `active` = 1 WHERE `email` = '$email'") or die("Failed to set user Active");
		//query to update user active status
		return true;

	}else
	{
		return false;
	}
}

function teacherLogged_in()
{
	return(isset($_SESSION['T_ID'])) ? true :  false;
}

function teacher_data($user_id)
{
	//echo $dbtable;
	$data = array();
	$user_id = (int)$user_id;

	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if($func_num_args > 1)
	{
		unset($func_get_args[0]);

		$fields = '`' . implode('`, `', $func_get_args) . '`';		
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `teachers` WHERE `T_ID` = $user_id")); 

        return $data;   

    }
}
function register_teacher($registerData)
{
	 $registerData[password] = md5($registerData[password]);
	 mysql_query("INSERT INTO `teachers` 
  				(firstname,lastname,username,password,email,emailcode,prefix,C_ID)
  						SELECT '$registerData[firstname]','$registerData[lastname]','$registerData[username]','$registerData[password]',
  						'$registerData[email]','$registerData[emailcode]','$registerData[prefix]',
					    (SELECT c.C_ID
					       FROM courses c
					       WHERE c.CourseName = '$registerData[subject]')") or die('failed to insert teacher');
	 email($registerData['email'],'Activate your account',"Hello ".$registerData['firstname'].",\n\n 
    	You need to activate your account, so use the link below:\n\n
    	http://skomat.com/teacher-activate.php?email=".$registerData['email']."&emailcode=".$registerData['emailcode']."\n\n
    	-admin");
}

function teacher_exists($dbtable,$dbtable_id,$username)
{
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`$dbtable_id`) FROM `$dbtable` WHERE `firstname` = '$username'");
	return (mysql_result($query, 0)==1) ? true : false;
}
function update_teacher_profile($update_data,$teacher_T_ID)
{
	array_walk($update_data,'array_sanitize');
	$update_data['password'] = md5($update_data['password']);
		
	mysql_query("UPDATE `teachers` SET 
						firstname ='$update_data[firstname]', 
						lastname  ='$update_data[lastname]', 
						password  ='$update_data[password]',
						email     ='$update_data[email]',
						C_ID      ='$update_data[course_id]',
						prefix    ='$update_data[prefix]' 
				WHERE T_ID=$teacher_T_ID") or die("Update Failed");

}

/*Get functions for teacher profiles*/
function get_coursename($teacher_C_ID)  
{
	//retriving data for the form 
	$coursesQuery     = mysql_query("SELECT CourseName FROM `courses` WHERE $teacher_C_ID =  C_ID ");
	$course           = mysql_fetch_assoc($coursesQuery); 
	return $course['CourseName'];
}
function get_course_id($course_name)
{

	$coursesQuery     = mysql_query("SELECT C_ID FROM `courses` WHERE '$course_name' =  CourseName");
	$course           = mysql_fetch_assoc($coursesQuery); 
	
	return $course['C_ID'];
}


?>