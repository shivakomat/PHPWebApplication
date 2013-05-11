<?php
include "core/init.php";
include "includes/overall-header.php";
student_protect_page();
// create query
$teacherQuery = "SELECT * FROM teachers"; 

// execute query
$result = mysql_query($teacherQuery) or die ("Error in query: $query. ".mysql_error()); 

$num_rows = mysql_num_rows($result);

?>
<!start of body content!>
    <div class="grid_12 omega" id="content">
        <! start of Main Link div tag !>
        <div id="mainLinks">
          <div id="leftBodyContent">  
            <div style="width:100%; margin-top:10%; color:#fff;">
            <div style="float:left; width:50%; text-align:left;"><h3>TEACHERS</h3></div>
            <div style="float:right; width:50%; text-align:left;"><h3>SUBJECT</h3></div>
            </div>        
            <div id="teachersDisplay">              
                <table  border="3px" cellspacing="0" cellpadding="0" align = "center">
                  <?php
                  for($i=0;$i<$num_rows;$i++)
                  {
                    $teacherPrefix        = mysql_result($result,$i,'prefix');
                    $teacherLastname      = mysql_result($result,$i,'lastname');
                    $teacherSubject       = mysql_result($result,$i,'C_ID');
                    $teacherProfileImg    = mysql_result($result,$i,'profile');
                    $teacherUsername      = mysql_result($result,$i,'username');
                    


                    $coursesQuery     = mysql_query("SELECT CourseName FROM `courses` WHERE $teacherSubject = C_ID ");
                    $course           = mysql_fetch_assoc($coursesQuery);                   
                    
                    
                    echo "<tr>
                            <td><a href=\"student-teacher-schedule.php?prefix=$teacherPrefix&teachername=$teacherLastname&teacherusername=$teacherUsername&teacherProfileValue=$teacherProfileImg\">$teacherPrefix&nbsp;$teacherLastname</a></td>";                            
                            if($teacherProfileImg == 1){
                               echo "<td><a href=\"student-teacher-schedule.php?prefix=$teacherPrefix&teachername=$teacherLastname&teacherusername=$teacherUsername&teacherProfileValue=$teacherProfileImg\"><img class=\"profileImg_thumnail\" src=\"/images/profile/$teacherUsername/_profile_img.jpg\"/></a></td>";

                            }
                            else
                            {
                               echo "<td><a href=\"student-teacher-schedule.php?prefix=$teacherPrefix&teachername=$teacherLastname&teacherusername=$teacherUsername&teacherProfileValue=$teacherProfileImg\"><img class=\"profileImg_thumnail\" src=\"images/profile/default_no_image_120x120.jpg\"/></a></td>";
                            }
                            echo "<td><a href=\"student-teacher-schedule.php?prefix=$teacherPrefix&teachername=$teacherLastname&teacherusername=$teacherUsername&teacherProfileValue=$teacherProfileImg\">$course[CourseName]</td>                          
                        </tr>";
                          
                  }
                  
                  ?>
                  
                </table> 
            </div>             
          </div> 
          <div id="rightBodyContent">
          	<h2 class="subPageTitleToRight">pick your teacher</h2>
            <div id="studentsLink" style="border:none; height:auto;"><a href="student-member.php"><img src="images/parents_icon_large_389x389.png"></a></div>
          </div>
        </div> <!end of main links div tag !>      

    </div>

<!end of body content!>
<?php include "includes/overall-footer.php"; ?>



