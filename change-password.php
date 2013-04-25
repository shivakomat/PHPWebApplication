<?php
//include "core/init.php";
include "includes/overall-header.php";

if(empty($_POST) === false)
{
	change_password($student_data['S_ID'],'students','S_ID',$_POST['password']);
}

?>

<form method="POST">
<ul>
	<li>ENTER NEW PASSWORD:<br>
	<input type="password" name="password">
	</li>	
	<li>
	<input type="submit" style="float:left;" name="submit" value="Log In">
	</li>
</ul>
</form>


<?php include "includes/overall-footer.php"; ?>
