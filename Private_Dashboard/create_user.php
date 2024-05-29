<?php

 require_once("include/connection.php");
   
   if(isset($_POST['reguser'])){
    
        
         $user_name = mysqli_real_escape_string($conn,$_POST['name']);
         $email_address = mysqli_real_escape_string($conn,$_POST['email_address']);
         $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT, array('cost' => 12));  //PASSWORD_ARGON2I//PASSWORD_ARGON2ID
         $user_status = mysqli_real_escape_string($conn,$_POST['user_status']);

	$q_checkadmin = $conn->query("SELECT * FROM `login_user` WHERE `email_address` = '$email_address'") or die(mysqli_error());
		$v_checkadmin = $q_checkadmin->num_rows;
		if($v_checkadmin == 1){
			echo '
				<script type = "text/javascript">
					alert("Email Address already taken");
					window.location = "dashboard.php";
				</script>
			';
		}else{
			$conn->query("INSERT INTO `login_user` VALUES('','$user_name', '$email_address', '$user_password', '$user_status')") or die(mysqli_error());
			echo '
				<script type = "text/javascript">
					alert("Saved Employee Info");window.location = "dashboard.php";
				</script>
			';
		}
	}	


 ?>