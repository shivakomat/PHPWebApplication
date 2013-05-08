<?php
include "core/init.php";
include "includes/overall-header.php";
student_protect_page();

$prefix = $_GET['prefix'];
$currentTeacher = $_GET['teachername'];
$currentTeacherUsername = $_GET['teacherusername'];
$currentTeacherProfileValue = $_GET['teacherProfileValue'];

$timeslots_query = "SELECT * FROM timeslots";
$result = mysql_query($timeslots_query);
$num_rows = mysql_num_rows($result);
$num_cols = 5;

$bookings_query = "SELECT * FROM bookings";
$bookings = mysql_query($bookings_query);
$num_booking_rows = mysql_num_rows($bookings);


?>
<!start of body content!>
    <div class="grid_12 omega" id="content">
        <! start of Main Link div tag !>
        <div id="mainLinks">
          <div id="leftBodyContent">
            <div style="background-color:#fff; height:auto; width:400px; margin-top:10%; padding:20px;">
              <h3>AVAILABILITY</h3>
              <table>              
              <?php
                $col = 0;
                $flag = true;
                echo "<tr>";
                for($i=0;$i<$num_rows;$i++)
                {     
                     
                        
                      if($col === $num_cols){
                      echo "</tr><tr>";
                      $col = 0;
                      }   

                      $timeslot = mysql_result($result, $i,'timeslot');

                      //start of booking table check
                      //checks the avaliable time slots and booked time slots 
                      for($b=0;$b<$num_booking_rows;$b++)
                      {
                         $bookedTime       = mysql_result($bookings, $b, 'Time_ID');
                         $bookedTeacher    = mysql_result($bookings, $b, 'T_ID');

                         $teachers_query   = mysql_query("SELECT * FROM `teachers` WHERE $bookedTeacher = T_ID ");
                         $teacher          = mysql_fetch_assoc($teachers_query);

                         $time_query       = mysql_query("SELECT * FROM `timeslots` WHERE $bookedTime = Time_ID ");
                         $time             = mysql_fetch_assoc($time_query);             


                         if($currentTeacher === $teacher['lastname'] && $timeslot === $time['timeslot'])
                         {
                            
                            $flag = false;
                            
                         }

                      }                       
                       
                      //end of booking check ALGO 
                      if($flag===true)
                      {  
                        echo "<td><div class='timeslot'><a href=\"student-teacher-timeslot-booked.php?teachername=$currentTeacher&timeslot=$timeslot\">$timeslot</a><div></td>";  
                      }
                      else if($flag === false)
                      {
                        echo "<td><div class='timeslot'>booked<div></td>"; 
                        $flag = true;
                      }
                      
                      $col++;         
                    
                }
                echo "</tr>";
              ?>
              </table>              
            </div>  
            <div style="background-color:#81B9BA; height:auto; width:400px; padding:20px; text-transform:uppercase;">
              <h3>MY SCHEDULE</h3>
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

                            $students_query   = mysql_query("SELECT * FROM `students` WHERE $bookedStudent = S_ID ");
                            $student          = mysql_fetch_assoc($students_query);

                            $teachers_query   = mysql_query("SELECT * FROM `teachers` WHERE $bookedTeacher = T_ID ");
                            $teacher          = mysql_fetch_assoc($teachers_query);

                            $time_query       = mysql_query("SELECT * FROM `timeslots` WHERE $bookedTime = Time_ID ");
                            $time             = mysql_fetch_assoc($time_query);

                            $teacherPrefix    = strtoupper($teacher['prefix']);
                            $teacherLastname  = strtoupper($teacher['lastname']);
                            echo "<tr><td><div class=\"displayTeacherName\">$teacherPrefix&nbsp;$teacherLastname</div></td>
                                      <td><div class=\"timeslot\">$time[timeslot]</div></td></tr>";
                         }
                      }


                ?>
              </table>
              </div>

          </div> 
          <div id="rightBodyContent">
          	<h2 style="text-align:center; padding-left:75px; padding-top:30px; text-transform:uppercase;"><?php echo "$_GET[prefix] $currentTeacher"; ?></h2>
            
              <?php 
              if($currentTeacherProfileValue==1){
                echo '<div id="studentsLink">';
                echo "<a href=\"student-member.php\"><img class=\"profileImg\" src=\"image.php?width=389&amp;height=389&amp;quality=100&amp;image=/Fletechers/images/profile/$currentTeacherUsername/_profile_img.jpg\"></a>";

              }
              else
              {
                echo '<div id="studentsLink" style="border:none; height:auto;">';
                echo "<img src=\"images/parents_icon_large_389x389.png\">";
              }
                            
              ?>
            </div>
          </div>
        </div> <!end of main links div tag !>      

    </div>

<!end of body content!>
<?php include "includes/overall-footer.php"; ?>



