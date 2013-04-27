<?php 
include "core/init.php";
include "includes/overall-header.php";
studentLogged_in_redirect();
teacherLogged_in_redirect();
?>

<!start of body content!>
    <div class="grid_12 omega" id="content">
	    <div class="grid_12 omega">
		    <div id="mainLinks" style="width:960px; margin:auto;">
		    	<h2 style="padding-top:20%;">THANK YOU FOR REGISTERING. YOU WILL RECIEVE A CONFIRMATION EMAIL SHORTLY.</h2>
		    	<h2 style="padding-top:3%;"><a href=teacher-login.php>CLICK HERE FOR TEACHER LOGIN PAGE</a></h2> 
			</div>
	    </div> 
    </div>
<!end of body content!>


<?php include "includes/overall-footer.php"; ?>