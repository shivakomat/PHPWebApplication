<?php
//user's function go here...
function recover($mode,$email,$type)
{
	$mode 	= sanitize($mode);
	$email  = sanitize($email);
	if($type === 'students')
	{
		$recover_data = student_data(user_id_from_email('students','S_ID',$email),'S_ID','firstname','username');
	}
	else if($type === 'teachers' )	
	{
		$recover_data = teacher_data(user_id_from_email('teachers','T_ID',$email),'T_ID','firstname','username');
		
	}
    if($mode == 'username')
    {   	
    	//recover username
    	email($email,'Your username', "Hello ". $recover_data['firstname']."\n\n Your username is: ". $recover_data['username']."\n\n-admin @ LionSoft ");

    }else if ($mode == 'password')
    {
    	//recover password
    	$generated_password = substr(md5(rand(999,999999)),0,8);
    	if($type === 'students'){
	    	change_password($recover_data['S_ID'],'students','S_ID',$generated_password);
	    	update_student($recover_data['S_ID'],'students','S_ID',array('password_recover' => '1'));
    	}else if($type === 'teachers'){
    		
    		change_password($recover_data['T_ID'],'teachers','T_ID',$generated_password);
	    	update_student($recover_data['T_ID'],'teachers','T_ID',array('password_recover' => '1'));
    	}

    	email($email,'Your temporary password', "Hello ". $recover_data['firstname']."\n\n Your temp password is: ". $generated_password."\n\n-admin @ LionSoft ");
    }

}
function update_student($id,$dbtable,$db_id,$update_data)
{
	$update = array();
	array_walk($update_data,'array_sanitize');
	foreach ($update_data as $field => $data) {
		$update[] = '`'. $field . '` = \'' . $data . '\'';
	}

	mysql_query("UPDATE `$dbtable` SET ". implode(',', $update) . " WHERE `$db_id` = $id");
}
function change_password($user_id,$dbtable,$dbtable_id,$password)
{
	$user_id = (int)$user_id;
	$password = md5($password);

	mysql_query("UPDATE `$dbtable` SET `password` = '$password',`password_recover` = 0 WHERE `$dbtable_id` = $user_id");
}
function register_user($dbtable,$register_data)
{
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
    $fields = '`'.implode('`,`', array_keys($register_data)).'`';
    $data = '\'' . implode('\',\'', $register_data) . '\'';
    mysql_query("INSERT INTO `$dbtable` ($fields) VALUES ($data)") or die("Failed to Register student");

}
function user_count($dbtable_id)
{
	return mysql_result(mysql_query("SELECT COUNT(`$dbtable_id`) FROM `students` WHERE `active` = 1"), 0);
}


function user_exists($dbtable,$dbtable_id,$username)
{
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`$dbtable_id`) FROM `$dbtable` WHERE `username` = '$username'");
	return (mysql_result($query, 0)==1) ? true : false;
}
function email_exists($dbtable,$dbtable_id,$email)
{
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`$dbtable_id`) FROM `$dbtable` WHERE `email` = '$email'");
	return (mysql_result($query, 0)==1) ? true : false;
}
function user_active($dbtable,$dbtable_id,$username)
{
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`$dbtable_id`) FROM `$dbtable` WHERE `username` = '$username' AND `active` = 1");
	return (mysql_result($query, 0)==1) ? true : false;
}
function user_id_from_username($dbtable,$dbtable_id,$username)
{
	
	$username = sanitize($username);
	$query = mysql_query("SELECT `$dbtable_id` FROM `$dbtable` WHERE `username` = '$username'");
	return mysql_result($query,0,$dbtable_id);

}
function user_id_from_email($dbtable,$dbtable_id,$email)
{
	
	$email = sanitize($email);
	$query = mysql_query("SELECT `$dbtable_id` FROM `$dbtable` WHERE `email` = '$email'");
	return mysql_result($query,0,$dbtable_id);

}
function login($dbtable,$dbtable_id,$username,$password)
{

	$user_id = user_id_from_username($dbtable,$dbtable_id,$username);

	$username = sanitize($username);
	$password = md5($password);

	$query = mysql_query("SELECT COUNT(`$dbtable_id`) FROM `$dbtable` WHERE `username` = '$username' AND `password` = '$password'"); 
  	return (mysql_result($query, 0)==1) ? $user_id : false;
}


?>