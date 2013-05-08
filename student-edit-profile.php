<?php
include "core/init.php";
include "includes/overall-header.php";
student_protect_page();
if(empty($_POST)== false)
{
  $password         = $_POST['password'];
  $confirmpassword  = $_POST['confirmpassword'];
  $firstname        = $_POST['firstname'];
  $lastname         = $_POST['lastname'];
  $phonenumber      = $_POST['phonenumber'];
  $email            = $_POST['email'];
  
  $dbtable_name     = 'students';// setting the global db table name to be used
  $dbtable_id       = 'S_ID';

  $changes_flag     = false;
  
  $required_fields  = array('password','firstname','lastname','phonenumber','email');

  foreach ($_POST as $key => $value) 
  {
  	if(empty($value) && in_array($key, $required_fields) === true)
  	{
  		$errors[] = 'Invalid Changes,Please Fill Out Data in all Fields';
  		break 1;
  	}
  } 
  if(empty($errors)===true)
  {  	
  	//code to validate each fields and then add it to the query
    if($firstname !== $student_data['firstname'])
    {
    	if(preg_match("/\\s/", $firstname) == true)//checking for spaces
    	{
    		$errors[] = "Your firstname must not have any spaces";
    	}
    }
    if($lastname !== $student_data['lastname'])
    {
    	if(preg_match("/\\s/", $lastname) == true)//checking for spaces
    	{
    		$errors[] = "Your lastname must not have any spaces";
    	}
    }
    if($password !== $student_data['password'])
    {
    	if(strlen($password) < 6 || strlen($password) > 30)//validating the length of password
    	{
    		$errors[] = 'Your password must be greater than 6 characters and less than 30 characters';

    	}
      if($password !== $confirmpassword)   
      {
        $errors[] = 'Password Do Not Match With Password Again';
      }
    }
   
  	if(filter_var($email,FILTER_VALIDATE_EMAIL) === false)
  	{
  		$errors[] = 'A valid email address is required';
  	}
    if($email !== $student_data['email'])
    {
    	if(email_exists($dbtable_name,$dbtable_id,$email) === true || email_exists('teachers','T_ID',$email) === true)
    	{
    		$errors[] = 'User already exists under the email \'' . $email . '\' please verify and re-type your new email';
    	} 
    } 
    if($phonenumber !== $student_data['phonenumber'])	
    {
    	if(!is_numeric($phonenumber) && strlen($phonenumber) > 9)
    	{
    		$errors[] = 'Invalid phone number, Enter a 9 digit phone number without spaces';

    	}
    }
	
  }
  foreach ($_POST as $key => $value) {
     if($key !== confirmpassword)
     {
       if($value !== $student_data[$key])
       {

          $changes_flag = true;
          break 1;

       } 
     }  
  }
  if($changes_flag === false)
  {
    $errors[] = 'No Changes Made!';
  }
  //update the changes into the data base
  if(empty($_POST) === false && empty($errors)===true)
  {
	  //save user profile changes
		  $update_data = array(

      'password'    => $password,
      'firstname'   => $firstname,
      'lastname'    => $lastname,
      'phonenumber' => $phonenumber,
      'email'       => $email   
      
    );
    update_student_profile($update_data,$student_data['username']);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL= student-member.php?savechanges=sucess">';
		exit();
  }
  
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
        <! start of Main Link div tag !>
        <div id="mainLinks">
          <div id="leftBodyContent">
            <div id="registrationForm" style="float:left;">  
              <form style="padding-top:30px;" action="student-edit-profile.php" method="post">
                <ul>
                  <table width="400px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
                        <li>
                          FIRSTNAME<br>
                          <input type="text" name="firstname" value="<?php echo "$student_data[firstname]" ?>">
                        </li>
                      </td>
                      <td>
                        <li>
                          LASTNAME<br>
                          <input type="text" name="lastname" value="<?php echo "$student_data[lastname]" ?>">
                        </li>
                      </td>
                    </tr>
                    <tr>
                      <th colspan="2">
                        <li>
                          PASSWORD<br>
                          <input style="width:100%;" type="password" name="password" value ="<?php echo "$student_data[password]" ?>">
                        </li>
                      </th>                      
                    </tr>
                    <tr>
                      <th colspan="2">
                        <li>
                          PASSWORD AGAIN<br>
                          <input style="width:100%;" type="password" name="confirmpassword">
                        </li>
                      </th>
                    </tr>                   
                    <tr>
                      <th colspan="2">
                        <li>
                          EMAIL*<br>
                          <input style="width:100%;" type="text" name="email" value="<?php echo "$student_data[email]" ?>">
                        </li>
                      </td>
                    </tr>             
                    <tr>
                      <th colspan="2">
                        <li>
                          PHONE NUMBER*<br>
                          <input style="width:100%;" type="text" name="phonenumber" value ="<?php echo "$student_data[phonenumber]" ?>">
                        </li>
                      </td>
                    </tr>             
                    <tr>
                      <th colspan="2">
                        <li style="margin-right:0; padding-top:20px; width:30%; font-weight:bold;">
                          <input type="submit" value="SAVE">
                        </li>
                      </td>
                    </tr> 
                  </table>                 
                </ul>
              </form> 
            </div>  
          </div> 
          <div id="rightBodyContent">
          	<h2 style="text-align:center; padding-left:75px; padding-top:30px;">MAKE YOUR CHANGES</h2>
            <div id="studentsLink" style="border:none; height:auto;"><a href="student-member.php"><img src="images/parents_icon_large_389x389.png"></a></div>
          </div>
        </div> <!end of main links div tag !>      

    </div>

<!end of body content!>
<?php include "includes/overall-footer.php"; ?>


