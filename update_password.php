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
    // Check if new password and noMatric are submitted
    if (!empty($_POST['matricNo']) && !empty($_POST['newPassword']) && !empty($_POST['confirmNewPassword'])) {
        $matricNo = $_POST['matricNo'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];

        if ($newPassword === $confirmNewPassword) {
            // Hash the password before storing it in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $sql = "UPDATE student SET pwd = '$hashedPassword' WHERE matricNo = '$matricNo'";
            if (mysqli_query($conn, $sql)) {
                // Update data into confidential table
                $sql_confidential = "UPDATE confidential SET pwd = '$newPassword' WHERE matricNo = '$matricNo'";
				if (mysqli_query($conn, $sql_confidential)) {
                    echo "";
                } else {
                    echo "Error updating confidential data: " . $sql_confidential . "<br>" . mysqli_error($conn);
                }
                echo '<script type="text/javascript">
                    alert("Password updated successfully!");
                    window.location.replace("index.php");
                </script>';
            } else {
                echo "Error updating password: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo '<script type="text/javascript">
                alert("Error: New Password and Confirm New Password do not match.\nPlease try again.");
                window.location.replace("forgot_password.php");
			</script>';
        }
    }
} 
// Close the database connection
mysqli_close($conn);
?>
</body>
</html>