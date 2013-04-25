<div id="membersNav">
	<ul class="nav">
		<?php
		if(studentLogged_in()=== true){
		?>	
			<li><a href="student-member.php">MY ACCOUNT</a></li>
			<li style="border-right:0px;"><a href="student-my-schedule.php">MY SCHEDULE</a></li>
		<?php 
		} 
		else if(teacherLogged_in() === true){
		?>
			<li><a href="teacher-member.php">MY ACCOUNT</a></li>
			<li style="border-right:0px;"><a href="teacher-my-schedule.php">MY SCHEDULE</a></li>
		<?php 
		}
		?>
	</ul>
</div>