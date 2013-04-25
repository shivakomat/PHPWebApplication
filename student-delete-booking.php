<?php
include "core/init.php";

$bookingID = $_GET['booked-id'];
$teacherLastname = $_GET['teacherLastname'];


mysql_query("DELETE FROM `bookings` WHERE B_ID = $bookingID") or die("Failed to delete");
echo '<META HTTP-EQUIV="Refresh" Content="0; URL= student-my-schedule.php">';
exit();

?>