<?php
include "core/init.php";
include "includes/overall-header.php";
teacherLogged_in_redirect();

//Start of Error Validation//

if(empty($_POST) === false)
{
   $username = $_POST['username'];
   $password = $_POST['password'];
   $dbtable_name = 'teachers';// setting the global db table name to be used
   $dbtable_id = 'T_ID';
 
  if(empty($username) === true || empty($password) === true)
  {
     $errors[]='You need to enter a username and password'; //storing the error into the error array from init.php
  }
  else if(user_exists($dbtable_name,$dbtable_id,$username)===false) {

     $errors[]='We can\'t find that username . Have you registered?';
  }
  else if(user_active($dbtable_name,$dbtable_id,$username)=== false){
    $errors[] = 'You havent activated your account';
  }
  else
  {
     $login = login($dbtable_name,$dbtable_id,$username,$password);
     if(strlen($password) > 32)
     {
          $errors[] = 'Password too long';
     }
     if($login === false)
     {
       $errors[] = 'That username/password combination is incorrect';
     }
     else
     {        
        //code to redirect the page to member page...
        $_SESSION['T_ID'] = $login;   
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL= teacher-member.php">';    
        exit();
     }
  }
}

//End of validation//
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

        <!start of mainlinks div !>
        <div id="mainLinks">          
          <div id="teachersLink"><a href="teacher-login.php">
            <h2 style="text-align:centre; padding-top:30px;">LOGIN</h2>
            <img src="images/teachers_icon_large_389x389.png"></a>
          </div>
          <div id="loginForm" style="float:right;">   
              <form action="teacher-login.php" method="POST">
              <ul>
                <li>USERNAME<br>
                  <input type="text" name="username">                 
                </li>
                <li>PASSWORD<br>
                  <input type="password" name="password">
                </li>
                <li style="font-size:15px; text-align:right;">FORGOT <a href="recover.php?mode=username&type=teachers"> USERNAME&nbsp;</a>OR<a href="recover.php?mode=password&type=teachers"> PASSWORD</a>?
                </li>
                <li>
                  <input type="submit" name="submit" value="Log In">
                </li> 
                <li>

                </li>          
              </ul>
              </form>               
          </div>
          
          <h5 style="text-align:right; float:right; color:#fff; padding-top:10%;">DON'T HAVE AN ACCOUNT ?&nbsp;<a href="teacher-register.php">SIGN UP NOW</a></h5>
         
        </div> 
        <!end of main links div tag !> 
</div>
<!end of body content!>


<?php include "includes/overall-footer.php"; ?>


  
