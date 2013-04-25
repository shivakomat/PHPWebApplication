<?php
include "core/init.php";
include "includes/overall-header.php";
student_protect_page();

$bookings_query = "SELECT * FROM bookings";
$bookings = mysql_query($bookings_query);
$num_booking_rows = mysql_num_rows($bookings);

?>
<!start of body content!>
    <div class="grid_12 omega" id="content">
        <! start of Main Link div tag !>
        <div id="mainLinks">
          <div id="leftBodyContent">
            <div id="studentMyScheduleDisplay">
              <h3 style="color:#333; text-align:left;">MY SCHEDULE</h3>
              <table width="400px" border="0px" cellspacing="0" cellpadding="0" align = "center">
                <?php
                 //start of booking table check
                      for($b=0;$b<$num_booking_rows;$b++)
                      {
                         $bookedStudent    = mysql_result($bookings, $b, 'S_ID');
                         if($bookedStudent === $student_data['S_ID'])
                         {
                            $bookedTeacher    = mysql_result($bookings, $b, 'T_ID');
                            $bookedTime       = mysql_result($bookings, $b, 'Time_ID');
                            $bookedID         = mysql_result($bookings, $b, 'B_ID');

                            $students_query   = mysql_query("SELECT * FROM `students` WHERE $bookedStudent = S_ID ");
                            $student          = mysql_fetch_assoc($students_query);

                            $teachers_query   = mysql_query("SELECT * FROM `teachers` WHERE $bookedTeacher = T_ID ");
                            $teacher          = mysql_fetch_assoc($teachers_query);

                            $time_query       = mysql_query("SELECT * FROM `timeslots` WHERE $bookedTime = Time_ID ");
                            $time             = mysql_fetch_assoc($time_query);

                            $teacherPrefix    = strtoupper($teacher['prefix']);
                            $teacherLastname  = strtoupper($teacher['lastname']);
                            echo "<tr><td>$teacherPrefix&nbsp;$teacherLastname</td>
                                      <td><div>$time[timeslot]</div></td>
                                      <td><a href=\"student-delete-booking.php?booked-id=$bookedID&teacherLastname=$teacher[lastname]&teacher_id=$teacher[T_ID]\"><img class=\"deleteButton\"src=\"images/minus_green_icon_26x27.png\"></a></td></tr>";
                         }
                      }

                ?>
              </table>            
            </div>
            <div style="width:432px; height:auto; padding-top:10px;">
              <div style="float:left; ">
                <img style="float:left;"src="images/mail_white_icon_45x44.png">
                <h3 style="float:right; color:#fff; line-height:1.7;">&nbsp;EMAIL</h3>
              </div> 
              <div style="float:left; padding-left:25px;">
                <img style="float:left;"src="images/print_white_icon_45x44.png">
                <h3 style="float:right; color:#fff; line-height:1.7;">&nbsp;PRINT</h3>
              </div>
              <div class="timeslot" style=" background-color:#85ECEB; float:right;  padding-left:20px; padding-right:20px; text-align:center;">
              <a href="student-member.php">BACK</a>
              </div>
            </div>            
          </div> <!end of left body content !>
          <div id="rightBodyContent">
          	<h2 style="text-align:center; padding-left:75px; padding-top:30px;">MY SCHEDULE</h2>
            <div id="studentsLink"><a href="student-member.php"><img src="images/parents_icon_large_389x389.png"></a>
            </div>
          </div>
        </div> <!end of main links div tag !>      

    </div>

<!end of body content!>
<?php include "includes/overall-footer.php"; ?>


