<?php
include "core/init.php";
include "includes/overall-header.php";
teacher_protected_page();

$bookings_query = "SELECT * FROM bookings";
$bookings = mysql_query($bookings_query);
$num_booking_rows = mysql_num_rows($bookings);

?>
<!start of body content!>
    <div class="grid_12 omega" id="content">
        <div id="mainLinks">
          <div id="leftBodyContent">
          	<h2 style="text-align:center; padding-right:75px; padding-top:30px;">MY SCHEDULE</h2>
            <?php
            //loads teacher profile image
            if($teacher_data['profile'] == 1)
            {
                             
              echo '<div id="teachersLink">';
              echo '<span><img class="profileImg" src="image.php?height=389&amp;quality=100&amp;image=/images/profile/'.$teacher_data['username'].'/_profile_img.jpg"></span>';
                  
            }
            else 
            {
              
              echo '<div id="teachersLink" style="border:none;">';
              echo '<a href="teacher-member.php"><img src="images/teachers_icon_large_389x389.png"></a>';
            }
            ?>
            </div>
          </div> 
          <div id="rightBodyContent">           
          	<div id="teacherMyScheduleDisplay">                           
              <h3 style="color:#333; text-align:left;">MY SCHEDULE</h3>
              <table width="400px" border="0px" cellspacing="0" cellpadding="0" align = "center">
                <?php
                 //start of booking table check
                      for($b=0;$b<$num_booking_rows;$b++)
                      {
                         $bookedTeacher    = mysql_result($bookings, $b, 'T_ID');                                  
                         //echo "<tr><td>$teacher_data[T_ID] /////  $bookedTeacher ///</td></tr>"; 


                         if($bookedTeacher === $teacher_data['T_ID'])
                         {
                            //echo " Inside If Statment"; 
                            
                            $bookedStudent    = mysql_result($bookings, $b, 'S_ID');
                            $bookedTime       = mysql_result($bookings, $b, 'Time_ID');

                            $teachers_query   = mysql_query("SELECT * FROM `teachers` WHERE $bookedTeacher = T_ID ");
                            $teacher          = mysql_fetch_assoc($teachers_query);

                            $students_query   = mysql_query("SELECT * FROM `students` WHERE $bookedStudent = S_ID ");
                            $student          = mysql_fetch_assoc($students_query);                            

                            $time_query       = mysql_query("SELECT * FROM `timeslots` WHERE $bookedTime = Time_ID ");
                            $time             = mysql_fetch_assoc($time_query);

                            echo "<tr><td><div>$time[timeslot]</div></td>
                            <td>$student[username]</td></tr>";
                         }
                      }
                ?>
              </table>
            </div>
          </div>
        </div> <!end of main links div tag !> 
    </div>
<!end of body content!>

<!Start of Error Displaying!>
<div class="grid_12 omega" id="errorDisplay">
   <?php 
    if(empty($errors) === false){
      echo output_errors($errors);
    }
   ?></div>
<!End of Error Displaying!>

<?php include "includes/overall-footer.php"; ?>