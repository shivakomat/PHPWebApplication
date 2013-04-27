<?php
include "core/init.php";
include "includes/overall-header.php";
teacher_protected_page();
$teacherPrefix   = strtoupper($teacher_data['prefix']);
$teacherLastname = strtoupper($teacher_data['lastname']);
?>
<!start of body content!>
    <div class="grid_12 omega" id="content">
        <div id="mainLinks">
          <div id="leftBodyContent">
          	<h2 style="text-align:center; padding-right:75px; padding-top:30px;"><?php echo "$teacherPrefix&nbsp;$teacherLastname"; ?></h2>
            <div id="teachersLink">
            <?php
            //loads teacher profile image 
            if(empty($teacher_data['profile'])===false)
            {
                             
               echo '<a href="teacher-member.php"><img class="profileImg" src="',$teacher_data['profile'],'"></a>';    
            }
            else 
            {
              
              echo '<a href="teacher-member.php"><img src="images/teachers_icon_large_389x389.png"></a>';
            }
            ?>
            </div>
          </div> 
          <div id="rightBodyContent">
          	<div id="membersBodyMenu">
            	<table width="350px" border="0px" cellspacing="0" cellpadding="0" align ="center">
                <tr>
                  <td style="padding-bottom:30px;"><a href="teacher-edit-profile.php"><img src="images/edit_profile_icon_75x75.png"></a></td>
                  <td style="vertical-align:top; padding:20px;"><a href="teacher-edit-profile.php">EDIT PROFILE</a></td>
                </tr>
                <tr>
                  <td style="padding-bottom:30px;"><a href="teacher-my-schedule.php"><img href="teacher-my-schedule.php" src="images/check_schedule_icon_75x75.png"></a></td>
                  <td style="vertical-align:top; padding:20px; tex-align:left;"><a href="teacher-my-schedule.php">CHECK SCHEDULE</a></td>
                </tr>
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