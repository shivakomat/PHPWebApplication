<?php
include "core/init.php";

student_protect_page();

$time = $_GET['timeslot'];
$currentTeacher = $_GET['teachername'];
$student = $student_data['username'];
$bookedFlag = false;
//echo "$time.$teacher.$student" ;
//search if the student booked an appointment with the teacher already
$bookings_query = "SELECT * FROM bookings";
$bookings = mysql_query($bookings_query);
$num_booking_rows = mysql_num_rows($bookings);
for($b=0;$b<$num_booking_rows;$b++)
{
	$bookedStudent    = mysql_result($bookings, $b, 'S_ID');
	$bookedTeacher    = mysql_result($bookings, $b,'T_ID');

	$teachers_query   = mysql_query("SELECT * FROM `teachers` WHERE $bookedTeacher = T_ID ");
    $teacher          = mysql_fetch_assoc($teachers_query);

    if($bookedStudent === $student_data['S_ID'] && $teacher['lastname'] === $currentTeacher)
	{
		$bookedFlag = true;
	}
	
}
//end of search and find
if($bookedFlag === false)
{
	mysql_query("INSERT INTO `bookings`(T_ID,S_ID,Time_ID) VALUES (
	(SELECT t.T_ID FROM teachers t WHERE t.lastname = '$currentTeacher'),
	(SELECT s.S_ID FROM students s WHERE s.username = '$student'),
	(SELECT time.Time_ID FROM timeslots time WHERE time.timeslot = '$time'))") or die('failed to insert');
}else if($bookedFlag===true)
{
	die("Sorry you have already booked an appointment with this teacher");

}
//echo"$student, you Booked time with the teacher $teacher to meet at $time!!!";
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=student-my-schedule.php">';
exit();

?>
