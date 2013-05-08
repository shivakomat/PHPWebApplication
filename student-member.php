<?php
include "core/init.php";
student_protect_page();

include "includes/overall-header.php";

?>
<!start of body content!>
    <div class="grid_12 omega" id="content">
        <div id="mainLinks">
          <div id="leftBodyContent">
            <div id="membersBodyMenu" style="float:left; margin:30% 0 0 10%;">
            	<table width="425px" border="0px" cellspacing="0" cellpadding="0" align ="center">
                <tr>
                  <td style="padding-bottom:30px;"><a href="student-my-schedule.php"><img src="images/my_schedule_icon_75x75.png"></a></td>
                  <td style="vertical-align:top; padding:20px;"><a href="student-my-schedule.php">MY SCHEDULE</a></td>
                </tr>
                <tr>
                  <td style="padding-bottom:30px;"><a href="student-edit-profile.php"><img src="images/edit_profile_icon_75x75.png"></a></td>
                  <td style="vertical-align:top; padding:20px;"><a href="student-edit-profile.php">EDIT PROFILE</a></td>
                </tr>
                <tr>
                  <td style="padding-bottom:30px;"><a href="student-createoredit-my-schedule.php"><img src="images/check_schedule_icon_75x75.png"></a></td>
                  <td style="vertical-align:top; padding:20px;"><a href="student-createoredit-my-schedule.php">CREATE/EDIT SCHEDULE</a></td>
                </tr>
              </table>
            </div>
          </div> 
          <div id="rightBodyContent">
          	<h2 style="text-align:center; padding-left:75px; padding-top:30px;"><?php echo "Hi $student_data[firstname]"; ?></h2>
            <div id="studentsLink" style="border:none; height:auto;"><a href="student-member.php"><img src="images/parents_icon_large_389x389.png"></a></div>
          </div>
        </div> <!end of main links div tag !>      

    </div>

<!end of body content!>
<?php include "includes/overall-footer.php"; ?>


