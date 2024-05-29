<?php

 require_once("include/connection.php");
   
   if(isset($_POST['reg'])){
    
        
         $user_name = mysqli_real_escape_string($conn,$_POST['name']);
         $user_email = mysqli_real_escape_string($conn,$_POST['admin_user']);
         $user_password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT, array('cost' => 12));  //PASSWORD_ARGON2I//PASSWORD_ARGON2ID
         $user_status = mysqli_real_escape_string($conn,$_POST['admin_status']);
         

	$q_checkadmin = $conn->query("SELECT * FROM `admin_login` WHERE `admin_user` = '$user_email'") or die(mysqli_error());
		$v_checkadmin = $q_checkadmin->num_rows;
		if($v_checkadmin == 1){
			echo '
				<script type = "text/javascript">
					alert("Email Address already taken");
					window.location = "dashboard.php";
				</script>
			';
		}else{
			$conn->query("INSERT INTO `admin_login` VALUES('','$user_name', '$user_email', '$user_password', '$user_status')") or die(mysqli_error());
			echo '
				<script type = "text/javascript">
					alert("Saved Admin Info");
					window.location = "dashboard.php";
				</script>
			';
		}
	}	


 ?>


