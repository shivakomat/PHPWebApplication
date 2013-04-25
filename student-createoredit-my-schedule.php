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
            <div style="width:100%; margin-top:30%; color:#fff;">
            <div style="float:left; width:50%; text-align:left;"><h3>TEACHERS</h3></div>
            <div style="float:right; width:50%; text-align:left;"><h3>SUBJECT</h3></div>
            </div>        
            <div id="teachersDisplay">              
                <table width="400px" border="3px" cellspacing="0" cellpadding="0" align = "center">
                  <?php
                  for($i=0;$i<$num_rows;$i++)
                  {
                    $teacherPrefix    = mysql_result($result,$i,'prefix');
                    $teacherLastname  = mysql_result($result,$i,'lastname');
                    $teacherSubject   = mysql_result($result,$i,'C_ID');

                    $coursesQuery     = mysql_query("SELECT CourseName FROM `courses` WHERE $teacherSubject = C_ID ");
                    $course           = mysql_fetch_assoc($coursesQuery); 

                    //$teacherPrefix    = strtoupper($teacherPrefix);
                    //$teacherLastname  = strtoupper($teacherLastname);

                    echo "<tr>
                            <td><a href=\"student-teacher-schedule.php?prefix=$teacherPrefix&teachername=$teacherLastname\">$teacherPrefix&nbsp;$teacherLastname</a></td> 
                            <td><a href=\"student-teacher-schedule.php?prefix=$teacherPrefix&teachername=$teacherLastname\">$course[CourseName]</td>                          
                          </tr>";
                  }
                  
                  ?>
                  
                </table> 
            </div>             
          </div> 
          <div id="rightBodyContent">
          	<h2 style="text-align:center; padding-left:75px; padding-top:30px;">PICK YOUR TEACHER</h2>
            <div id="studentsLink"><a href="student-member.php"><img src="images/parents_icon_large_389x389.png"></a></div>
          </div>
        </div> <!end of main links div tag !>      

    </div>

<!end of body content!>
<?php include "includes/overall-footer.php"; ?>



