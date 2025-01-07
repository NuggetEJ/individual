<?php
include("config.php");
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
</head>
<body>
<?php

//STEP 1: Form data handling using mysqli_real_escape_string function to escape special characters for use in an SQL query,
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studName = mysqli_real_escape_string($conn, $_POST['studName']);
    $matricNo = mysqli_real_escape_string($conn, $_POST['matricNo']);
    $studEmail = mysqli_real_escape_string($conn, $_POST['studEmail']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);

    //Validate pwd and confrimPwd
    if ($pwd !== $confirmPwd) {
        echo '<script type="text/javascript">
            alert("Password and confirm password do not match.\nPlease register again.");
            window.location.replace("index.php");
        </script>';
    } 

    //STEP 2: Check if matricNo already exist
    $sql = "SELECT * FROM student WHERE matricNo='$matricNo' LIMIT 1";
    $result = mysqli_query($conn, $sql);
	
    if (mysqli_num_rows($result) == 1) {
		echo '<script type="text/javascript">
            alert("Error: User exists, please register a new user");
            window.location.replace("index.php");
        </script>';
	} else {
		// User does not exist, insert new user record, hash the password		
		$pwdHash = trim(password_hash($_POST['pwd'], PASSWORD_DEFAULT)); 
		
        //echo $pwdHash;
		$sql_student = "INSERT INTO student (studName, matricNo, studEmail, pwd) VALUES ('$studName','$matricNo','$studEmail', '$pwdHash')";
		if (mysqli_query($conn, $sql_student)) {
            // Insert into confidential table
            $sql_confidential = "INSERT INTO confidential (matricNo, pwd) VALUES ('$matricNo','$pwd')";
            if (mysqli_query($conn, $sql_confidential)) {
                echo "";
            } else {
                echo "Error: " . $sql_confidential . "<br>" . mysqli_error($conn);
            }
            echo '<script type="text/javascript">
                alert("New user record created successfully. Welcome '.$studName.'!");
                window.location.replace("index.php");
            </script>';		
		} else {
		echo "Error: " . $sql_student . "<br>" . mysqli_error($conn);
		}	
	}
}
mysqli_close($conn);
?>
</body>
</html>