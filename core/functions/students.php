<?php
function activate_student($email,$emailcode)
{
	$email = mysql_real_escape_string($email);
	$emailcode = mysql_real_escape_string($emailcode);

	if(mysql_result(mysql_query("SELECT COUNT(`S_ID`) FROM `students` WHERE `email` = '$email' AND `emailcode` = '$emailcode' AND `active` = 0"), 0) == 1)
	{
		mysql_query("UPDATE `students` SET `active` = 1 WHERE `email` = '$email'") or die("Failed to set user Active");
		//query to update user active status
		return true;

	}else
	{
		return false;
	}
}
function studentLogged_in()
{
	return(isset($_SESSION['S_ID'])) ? true :  false;
}
function student_data($user_id)
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
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `students` WHERE `S_ID` = $user_id")); 

        return $data;   

    }
}
function register_student($register_data)
{
	 array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
    $fields = '`'.implode('`,`', array_keys($register_data)).'`';
    $data = '\'' . implode('\',\'', $register_data) . '\'';

    mysql_query("INSERT INTO `students` ($fields) VALUES ($data)") or die("Failed to Register Data");
    email($register_data['email'],'Activate your account',"Hello ".$register_data['firstname'].",\n\n 
    	You need to activate your account, so use the link below:\n\n
    	http://skomat.com/student-activate.php?email=".$register_data['email']."&emailcode=".$register_data['emailcode']."\n\n
    	-admin");
}
function update_student_profile($update_data,$username)
{
	array_walk($update_data,'array_sanitize');
	$update_data['password'] = md5($update_data['password']);	
	mysql_query("UPDATE `students` SET 
						firstname='$update_data[firstname]', 
						lastname='$update_data[lastname]', 
						password='$update_data[password]',
						email='$update_data[email]'
				WHERE username='$username'") or die("Update Failed");

}
function TestErrorMsg()
{
	$errors['test'] = 'Fields marked with an asterisk are required';
	return $errors;
}

?>