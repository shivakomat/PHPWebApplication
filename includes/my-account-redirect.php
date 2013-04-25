<?php 

if(studentLogged_in()=== true)
{
	$redirectMyAccountPg = "student-member.php";
	$redirectMySchedulePg = "student-my-schedule.php";
}
}
else if(teacherLogged_in()=== true)
{
	$redirectMyAccountPg = "teacher-member.php";
	$redirectMySchedulePg = "teacher-my-schedule.php";
}

?>