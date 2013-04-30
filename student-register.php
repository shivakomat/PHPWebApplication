<?php
include "core/init.php";
include "includes/overall-header.php";
studentLogged_in_redirect();
//Start of Error Validation//
if(empty($_POST) === false)
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $phonenumber = $_POST['phonenumber'];
  $email = $_POST['email'];

  $dbtable_name = 'students';// setting the global db table name to be used
  $dbtable_id = 'S_ID';

  $required_fields = array('username','password','firstname','lastname','phonenumber','email');
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
  	//code to validate each fields and then add it to the query
  	if(!is_numeric($username))
  	{
  		$errors[] = 'Invalid Type Username, Please enter a student id number';
  	}  	
  	if(user_exists($dbtable_name,$dbtable_id,$username) === true)//chekcing for existing username
  	{
  		$errors[] = 'Sorry, the username \'' . $username . '\' is already taken.';
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
  	if(strlen($password) < 6 || strlen($password) > 30)//validating the length of password
  	{
  		$errors[] = 'Your password must be greater than 6 characters and less than 30 characters';

  	}  	
	if(filter_var($email,FILTER_VALIDATE_EMAIL) === false)
	{
		$errors[] = 'A valid email address is required';
	}
	if(email_exists($dbtable_name,$dbtable_id,$email) === true || email_exists('teachers','T_ID',$email) === true)
	{
		$errors[] = 'Sorry, the email \'' . $email . '\' is already taken.';
	}
	
	if(!is_numeric($phonenumber) && strlen($phonenumber) > 9)
	{
		$errors[] = 'Invalid phone number, Enter a 9 digit phone number without spaces';

	}
	
  }
}
if(empty($_POST) === false && empty($errors)===true)
{
	//register user
		$register_data = array(

			'username' 		=> $username,
			'password' 		=> $password,
			'firstname' 	=> $firstname,
			'lastname'		=> $lastname,
			'phonenumber'   => $phonenumber,
			'email' 		=> $email,
			'emailcode'		=> md5($username + microtime())
			
		);
		register_student($register_data);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL= student-registration-sucess.php">';
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
          	<div id="registrationForm" style="float:left;">   
	            <form style="padding-top:20%;" action="" method="post">
	 				<ul>
	 					<table width="400px;" border="0" cellspacing="0" cellpadding="0">
	 						<tr>
	 							<td>
	 								<li>
										FIRSTNAME*<br>
										<input type="text" name="firstname" value="<?php echo "$firstname" ?>">
									</li>
	 							</td>
	 							<td>
	 								<li>
										LASTNAME*<br>
										<input type="text" name="lastname" value="<?php echo "$lastname" ?>">
									</li>
	 							</td>
	 						</tr>
	 						<tr>
	 							<td>
	 								<li>
										STUDENT ID*<br>
										<input style="width:100%;" type="text" placeholder="100338919" name="username" value ="<?php echo "$username" ?>">
									</li>
	 							</td>
	 							<td>
	 								<li>
										PASSWORD*<br>
										<input style="width:100%;" type="password" name="password">
									</li>
	 							</td>
	 						</tr>
	 						
	 						
	 						<tr>
	 							<th colspan="2">
	 								<li>
										EMAIL*<br>
										<input style="width:100%;" type="text" placeholder="example@email.com" name="email" value="<?php echo "$email" ?>">
									</li>
	 							</td>
	 						</tr>	 						
	 						<tr>
	 							<th colspan="2">
	 								<li>
										PHONE NUMBER*<br>
										<input style="width:100%;" type="text" placeholder="905 416 2890" name="phonenumber" value ="<?php echo "$phonenumber" ?>">
									</li>
	 							</td>
	 						</tr>	 						
	 						<tr>
	 							<th colspan="2">
	 								<li style="margin-right:0; padding-top:20px; width:30%; font-weight:bold;">
										<input type="submit" value="SUBMIT">
									</li>
	 							</td>
	 						</tr>					
							

						</table>
					</ul>
				</form>   
           	</div> 
          </div> 
          <div id="rightBodyContent">
          	<h2 style="text-align:center; padding-left:75px; padding-top:30px;">SIGN UP</h2>
            <div id="studentsLink"><a href="student-login.php"><img src="images/parents_icon_large_389x389.png"></a></div>
          </div>
        </div> <!end of main links div tag !>     
    </div>

<!end of body content!>



<?php include "includes/overall-footer.php"; ?>