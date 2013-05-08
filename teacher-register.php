<?php
include "core/init.php";
include "includes/overall-header.php";
teacherLogged_in_redirect();
//Start of Error Validation//
if(empty($_POST) === false)
{

  $prefix = $_POST['prefix'];
  $subject = $_POST['subject'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $dbtable_name = 'teachers';// setting the global db table name to be used
  $dbtable_id = 'T_ID';

  $required_fields = array('firstname','lastname','username','password','subject','prefix','email');
  foreach ($_POST as $key => $value) 
  {
  	if(empty($value) && in_array($key, $required_fields) === true)
  	{
  		$errors[] = 'Fields marked with an asterisk are required';
  		break 1;
  	}
  }
  
  if(empty($errors)===true)
  {
  	if($prefix === "empty")// seperate check for prefix
	{
	  	 $errors[] = 'Prefix Must Be Selected';
	}
    if($subject === "empty")// seperate check for prefix
	{
	  	 $errors[] = 'Subject Must be Selected';
	}
  	//code to validate each fields and then add it to the query
  	if(user_exists($dbtable_name,$dbtable_id,$username) === true)//chekcing for existing username
  	{
  		$errors[] = 'Sorry, the teacher named\'' . $_POST['firstname'] . '\' is already either registered or taken.';
  	}
  	if(preg_match("/\\s/", $username) == true)//checking for spaces
  	{
  		$errors[] = "Your username must not have any spaces";
  	}
  	if(preg_match("/\\s/", $firstname) == true)//checking for spaces
  	{
  		$errors[] = "Your firstname must not have any spaces";
  	}
  	if(preg_match("/\\s/", $lastname) == true)//checking for spaces
  	{
  		$errors[] = "Your lastname must not have any spaces";
  	}
  	if(strlen($password) < 6 || strlen($_POST['password']) > 30)//validating the length of password
  	{
  		$errors[] = 'Your password must be agreater than 6 characters and less than 30 characters';

  	}
	if(filter_var($email,FILTER_VALIDATE_EMAIL) === false)
	{
		$errors[] = 'A valide email address is required';
	}
	if(email_exists($dbtable_name,$dbtable_id,$email) === true || email_exists('students','S_ID',$email) === true)
	{
		$errors[] = 'Sorry, the email \'' . $email . '\' is already taken.';
	}	
  }
}

if(empty($_POST) === false && empty($errors)===true)
{
	//register user
		$register_data = array(
			'username'      => $username,
			'firstname' 	=> $firstname,
			'password' 		=> $password,
			'prefix' 		=> $prefix,
			'lastname'		=> $lastname,
			'email' 		=> $email,
			'subject'       => $subject,
			'emailcode'		=> md5($username + microtime())
		);
		register_teacher($register_data);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL= teacher-registration-sucess.php">'; 
		exit();
}
?>

<!Start of Error Displaying!>
<div class="grid_12 omega" id="errorDisplay">
   <?php 
    if(empty($errors) === false){
      echo output_errors($errors);
    }
   ?>
</div>
<!End of Error Displaying!>
<!start of body content!>
    <div class="grid_12 omega" id="content">
        <div id="mainLinks">
          <div id="leftBodyContent">
          	<h2 style="text-align:center; padding-right:75px; padding-top:30px;">SIGN UP</h2>
            <div id="teachersLink"style="border:none;"><a href="teacher-login.php"><img src="images/teachers_icon_large_389x389.png"></a></div>
          </div> 
          <div id="rightBodyContent">
          	<div id="registrationForm">   
	            <form style="padding-top:20px; font-style:normal;" action="teacher-register.php" method="post">
	 				<ul>
	 					<table width="400px;" border="0" cellspacing="0" cellpadding="0">
	 						<tr>
	 							<th colspan="2">
	 								<li >Title*<br>
	 								<select name="prefix" style="width:75px;">
									  <option><?php echo "$prefix" ?></option>	
									  <option value="Mr.">Mr</option>
									  <option value="Mrs.">Mrs</option>
									  <option value="Ms.">Ms</option>		
									</select>									
									</li>
	 							</th>	 							
	 						</tr>
	 						<tr>	
	 							<td>
			 						<li>First Name*<br>
									<input type="text" name="firstname" value="<?php echo "$firstname" ?>" title="Enter Your FirstName">
									</li> 
								</td>

	 							<td>
	 								<li>Last Name*<br>
									<input type="text" name="lastname"  value="<?php echo "$lastname" ?>">
									</li>
								</td>
	 						</tr>
	 						<tr>
	 							<td>
			 						<li>Username*<br>
									<input style="width=100%; text-transform:lowercase;" type="text" name="username" value ="<?php echo "$username" ?>">
									</li> 
								</th>
								<td>
			 						<li>Password*<br>
									<input type="password" name="password">
									</li> 
								</th>
	 						</tr>
	 						<tr>
	 							
	 							
	 						</tr>	 						
							<tr>	 							
	 							<th colspan="2">
			 						<li>Email*<br>
									<input style="width:100%;" type="text" name="email" placeholder="myemail@peel.sb.com" value="<?php echo "$email" ?>">
									</li>
								</th>	 							
	 						</tr>
	 						<tr>
	 							<th colspan="2">
	 								<li>Subject*<br>
									<select name="subject" style="width:50%;">
									  <option><?php echo "$subject" ?></option>	
									  	<?php
											$getTeacherDropdown = mysql_query("SELECT * FROM `courses`");
								   			 while($row = mysql_fetch_array($getTeacherDropdown))
								   			 {
								        		echo "<option value=\"".$row['CourseName']."\">".$row['CourseName']."</option>";
								   			 }   
							   			?>			
									</select>
									</li>
								</th>
	 						</tr>
	 						<tr>
	 							<th colspan="2"> 	 				
			 						<li style="padding-top:20px; width:30%; font-weight:bold;"><input type="submit" value="SUBMIT"></li>
								</th>	 							
	 						</tr>				
	 						
	 					</table>	
	 									
					</ul>
				</form>   
           	</div> 
          </div>
        </div> <!end of main links div tag !> 
    </div>

<!end of body content!>


<?php include "includes/overall-footer.php"; ?>