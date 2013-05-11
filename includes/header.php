<body>
<!start of header!>
<div class="container clearfix">
    <div class="grid_12 omega">
        	
            <div id="header">
            	<?php 
            		if(studentLogged_in()=== true || teacherLogged_in() === true)
            		{
            			include "includes/logout-button.php";
            		}
            	?>
                <div id="logo"><img  src="images/logo_114x150.png"></div>
                <div id="title"><h1>FLETCHER`S MEADOW</h1></div>

                <!For Members Area Only - Need to be rectified later!>
                <?php 
            		if(studentLogged_in()=== true || teacherLogged_in() === true)
            		{
            			include "includes/member-nav.php";
		            }
		        ?>                
            </div>        
    </div>
    
<!end of header !>