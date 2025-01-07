<?php
include("config.php");
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['matricNo'])) {
        $matricNo = $_POST['matricNo'];

        $sql = "SELECT * FROM student WHERE matricNo = '$matricNo' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // Display password update form
            echo "<br>
            <fieldset><legend><b>Reset Password Information<b></legend>
            <form method='post' action='update_password.php'>
                <input type='hidden' name='matricNo' value='$matricNo'><br>
                <label for='newPassword'>New Password:</label><br>
                <input type='password' name='newPassword' id='newPassword' minlength=8 required><br><br>

                <label for='confirmNewPassword'>Confirm New Password:</label><br>
                <input type='password' name='confirmNewPassword' id='confirmNewPassword' minlength=8 required><br>

                <br><button type='submit'>Update Password</button>
            </form></fieldset>";
            echo '<br><center><a href="forgot_password.php">Cancel</a></center>';
        } else {
            echo '<script type="text/javascript">
                alert("Error: Student ID not found in the database.\nPlease try again.");
                window.location.replace("forgot_password.php");
			</script>';
        }
    }
} 
mysqli_close($conn);
?>
<br>
<footer>
	<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
</footer>
</body>
</html>