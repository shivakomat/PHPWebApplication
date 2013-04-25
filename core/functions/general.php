<?php
	function email($to, $subject, $body)
	{
		mail($to,$subject,$body,'From: admin@skomat.com');
	}
	function studentLogged_in_redirect(){
		if(studentLogged_in() === true)
		{
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL= student-member.php">'; 
		}
	}
	function teacherLogged_in_redirect(){
		if(teacherLogged_in() === true)
		{

			echo '<META HTTP-EQUIV="Refresh" Content="0; URL= teacher-member.php">'; 
		}
	}	
	function student_protect_page()
	{	
		if(studentLogged_in() === false)
		{
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL= protected.php">'; 
			exit();	
			
		}
	}
	function teacher_protected_page()
	{
		if(teacherLogged_in() === false)
		{
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL= protected.php">'; 
			exit();
		}
	}
    function array_sanitize($item)
    {
    	$item = mysql_real_escape_string($item);

    }
	function sanitize($data)
	{
		return mysql_real_escape_string($data);
	}

	function output_errors($errors)
	{
		return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
	}
	
?>


