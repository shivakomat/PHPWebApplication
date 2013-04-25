<?php 
include "core/init.php";
include "includes/overall-header.php";
studentLogged_in_redirect();
teacherLogged_in_redirect();

$email = $_POST['email'];
$sucess_flag = false;

if(isset($_GET['sucess']) === true && empty($_GET['sucess']) === true)
{
	$sucess_flag = true;
}
else
{
	if(isset($email) === true && empty($email) === false)
	{
    if($_GET['type'] === 'students' && email_exists('students','S_ID',$email) === true)
    {
      
        recover($_GET['mode'],$email,$_GET['type']);
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL= recover.php?sucess">';
        exit();
     
    }
		else if($_GET['type'] === 'teachers' && email_exists('teachers','T_ID',$email) === true)
		{
			  recover($_GET['mode'],$email,$_GET['type']);
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL= recover.php?sucess">';
        exit();
		}
		else
		{
			$errors[] = 'Invalid Email, Couldnt find that email address';
		}
	}
}//end of else statment 
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
<div class="grid_12 alpha" id="content">   

     <!start of main links!>
    <div id="mainLinks">
      <div id="studentsLink"><h2 style="text-align:centre; padding-top:30px;">RECOVER</h2><a href="student-login.php"><img src="images/parents_icon_large_389x389.png"></a></div>
       <div id="loginForm" style="float:left;">
       	  <?php
       	  $mode_allowed = array('username','password');
       	  if(isset($_GET['type']) === true && empty($_GET['type']) === false)
       	  {

       	  	if(isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true)
       	  	{
       	  	
       	  	 ?>
       	  	 <form action="" method="POST">
              <ul>
                   <li>YOUR EMAIL ADDRESS :<br>
                   	   <input type='text' name = 'email'> 
                   </li>
                   <br>  
                   <li><input type='submit' value='Recover' style="float:left;"></li>    
              </ul>
             </form>
             <?php 
         	}

       	  }
       	  else if($sucess_flag === true)
       	  {

       	  	echo '<h3>Your username has been sent to your email address</h3>';
       	  }
       	  else
       	  {
       	  	echo '<META HTTP-EQUIV="Refresh" Content="0; URL= index.php">';
			exit();
       	  }
       	  ?>   
                        
      </div>         
      
    </div>         
    <!end of main links!>  

</div>
<!end of body content!>


<?php include "includes/overall-footer.php"; ?>
