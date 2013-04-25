<?php
include "core/init.php";
include "includes/overall-header.php";
teacherLogged_in_redirect();
$sucess_flag = false;
if(isset($_GET['sucess']) === true && empty($_GET['sucess']) === true)
{
	$sucess_flag = true;
					
}	
else
{
	if(isset($_GET['email'],$_GET['emailcode']) === true)
	{
		$email 		=trim($_GET['email']);
		$emailcode  =trim($_GET['emailcode']);

		if(email_exists('teachers','T_ID',$email) === false)
		{
			$errors[] = 'Oopps, something went wrong cudnt find that email address';

		}else if(activate_teacher($email,$emailcode)===false)
		{
			$errors[] = 'We had problems activating your account';
		}

	}
	else
	{
		echo"not set";
		//echo '<META HTTP-EQUIV="Refresh" Content="0; URL= index.php">';
		//exit();
	}
	if(empty($errors) === true)
	{	
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL= teacher-activate.php?sucess">'; 
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
        <?php 
        if($sucess_flag === true)
        { ?>
	        <h2>You have sucessfully Activated your account</h2>
			<h2><a href="teacher-login.php">Click Here you to login!!</a></h2> 
		<?php
		}?>     
        <!end of main links!>  

    </div>
<!end of body content!>

<?php include "includes/overall-footer.php"; ?>
