<?php
include "core/init.php";
include "includes/overall-header.php";


teacher_protected_page();
if(empty($_POST) === false)
{
  $subject          = $_POST['subject'];
  $firstname        = $_POST['firstname'];
  $lastname         = $_POST['lastname'];
  $email            = $_POST['email'];
  $password         = $_POST['password'];
  $confirmpassword  = $_POST['confirmpassword'];
  $prefix           = $_POST['prefix'];

  $dbtable_name = 'teachers';// setting the global db table name to be used
  $dbtable_id = 'T_ID';

  $changes_flag = false;

  $required_fields = array('firstname','lastname','password','subject','email');
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
    if($firstname !== $teacher_data['firstname'])
    {
      if(preg_match("/\\s/", $firstname) == true)//checking for spaces
      {
        $errors[] = "Your firstname must not have any spaces";
      }
    }
    if($lastname !== $teacher_data['lastname'])
    {
      if(preg_match("/\\s/", $lastname) == true)//checking for spaces
      {
        $errors[] = "Your lastname must not have any spaces";
      }
    }
    if($password !== $teacher_data['password'])
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
    if($email !== $teacher_data['email'])
    {
      if(filter_var($email,FILTER_VALIDATE_EMAIL) === false)
      {
        $errors[] = 'A valide email address is required';
      }
      if(email_exists($dbtable_name,$dbtable_id,$email) === true || email_exists('students','S_ID',$email) === true)
      {
        $errors[] = 'Sorry, the email \'' . $email . '\' is already taken.';
      } 
    }
  }// end of if statment for errors
  foreach ($_POST as $key => $value) 
  {
      if($key !== 'subject')
      {
        if($key !== confirmpassword)
        {
          if($value !== $teacher_data[$key])
           {
              $changes_flag = true;
              break 1;
           }
        }
      }
      else
      {
        if($value !== get_coursename($teacher_data['C_ID']))
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
      
      
    $course_id = get_course_id($subject);     
  //save user profile changes
    $update_data = array(

    'password'    => $password,
    'firstname'   => $firstname,
    'lastname'    => $lastname,
    'email'       => $email,
    'course_id'   => $course_id,
    'prefix'      => $prefix      
     );

    update_teacher_profile($update_data,$teacher_data['T_ID']);
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL= teacher-member.php?savechanges=sucess">';
    exit();
  }
 

}// end of outter most if statment 
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
          	<h2 style="text-align:center; padding-right:75px; padding-top:30px;">EDIT PROFILE</h2>            
              <?php 
               if(isset($_FILES['profile'])===true)
                {
                  if(empty($_FILES['profile']['name']) === true)
                  {
                      echo "Please Choose A File";
                  }else
                  {
                      $allowed = array('jpg','jpeg','gif','png');
                      $file_name = $_FILES['profile']['name'];
                      $file_extn = strtolower(end(explode('.', $file_name)));
                      $file_temp = $_FILES['profile']['tmp_name'];

                      if(in_array($file_extn, $allowed) === true)
                      {
                        
                        change_profile_image($teacher_data['T_ID'],$teacher_data['username'],$file_temp,$file_extn);
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL= teacher-edit-profile.php">';
                        exit();
                       

                      }else {
                        echo 'incorrect file type. Allowed: ';
                        echo implode(',', $allowed);

                      }

                      
                  }
                }         
               if($teacher_data['profile'] == 1)
                { 
                   echo '<div id="teachersLink">';
                   echo '<span><img class="profileImg" src="image.php?width=389&amp;height=389&amp;quality=100&amp;image=/Fletechers/images/profile/'.$teacher_data['username'].'/_profile_img.jpg"></span>';

                }
                else 
                {
                  echo '<div id="teachersLink" style="border:none;">';
                  echo '<a href="teacher-member.php"><img src="images/teachers_icon_large_389x389.png"></a>';
                }
              ?>            
             
            </div>
             <div id="profilePicUpload">
              <form  action="" method="post" enctype="multipart/form-data">
                <input type="file" name="profile"><br>
                <input type="submit" value="UPLOAD">
              </form>
            </div>

          </div> 
          <div id="rightBodyContent">
            <div id="registrationForm" style="padding-top:30px; width:500px;"> 
              <form action="teacher-edit-profile.php" method="post">
              <ul>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th colspan="2">
                        <li style="width:75px;">Prefix<br>
                        <select name="prefix" style="width:100%;">
                          <option value="<?php echo $teacher_data['prefix']; ?>" > <?php echo "$teacher_data[prefix]"; ?></option>  
                          <option value="Mr">Mr</option>
                          <option value="Mrs">Mrs</option>
                          <option value="Ms">Ms</option>    
                        </select>                
                        </li>
                      </th>               
                    </tr>
                    <tr>  
                      <td>
                        <li>First Name<br>
                        <input type="text" name="firstname" value="<?php echo "$teacher_data[firstname]"; ?>">
                        </li> 
                      </td>

                      <td>
                        <li>Last Name<br>
                        <input type="text" name="lastname"  value="<?php echo "$teacher_data[lastname]" ?>">
                        </li>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <li>Password<br>
                        <input style="width=100%;" type="password" name="password" value ="<?php echo "$teacher_data[password]" ?>">
                        </li> 
                      </th>
                      <td>
                        <li>Password Again<br>
                        <input type="password" name="confirmpassword">
                        </li> 
                      </td>                      
                    </tr>                                
                    <tr>                
                      <th colspan="2">
                        <li>Email<br>
                        <input style="width:100%;" type="text" name="email" value="<?php echo "$teacher_data[email]" ?>">
                        </li>
                      </th>               
                    </tr>
                    <tr>
                      <th colspan="2">
                        <li>Subject<br>
                         <select name="subject" style="width:50%;">
                            <option value="<?php echo get_coursename($teacher_data[C_ID]); ?>"><?php echo get_coursename($teacher_data[C_ID]); ?></option>  
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
                        <li style="padding-top:20px; width:30%; font-weight:bold;">
                          <input type="submit" value="SAVE" action="teacher-edit-profile.php"></li>
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