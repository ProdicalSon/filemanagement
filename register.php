<?php
require_once("../include/connection.php");

session_start();

if (isset($_POST["register"])) {

    date_default_timezone_set("Africa/Nairobi");
    $date = date("M-d-Y h:i A", strtotime("+0 HOURS"));

    $Username = mysqli_real_escape_string($conn, $_POST["Username"]);
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $Password = mysqli_real_escape_string($conn, $_POST["Password"]);
    $hashed_Password = password_hash($Password, PASSWORD_DEFAULT);

    // Check if email already exists
    $query = mysqli_query($conn, "SELECT * FROM user_registration WHERE email = '$Email'") or die(mysqli_error($conn));
    $counter = mysqli_num_rows($query);

    if ($counter > 0) {
        echo "<script type='text/javascript'>alert('Email already exists. Please try again with a different email!');
        document.location='../register.html'</script>";
    } else {
        // Insert new user data into the database
        $sql = "INSERT INTO user_registration (username, email, password, registration_date) VALUES ('$Username', '$Email', '$hashed_Password', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Registration successful!');
            document.location='../login.html'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
