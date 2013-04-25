<?php
include "core/init.php";
include "includes/header.php";
//admin interface page

?>
<div id="wrapper">
	<h1>Admin Panel</h1>
	<h2>Set Custom Time Slots</h2>
	<div id="loginForm">
		<form action="admin.php" method="post">
			<ul>
				<li>Time Slot 1:<br>
					<input type="time" name="S_Time1">
					<input type="time" name="E_Time1">
				</li>
				<li>
					Time Slot 2:<br>
					<input type="time" name="S_Time2">
					<input type="time" name="E_Time2">
				</li>		
				<li>
					<input style="width:200px;" type="submit" value="Register Time Slots">
				</li>
		    </ul>
		</form>
	</div>

</div>

