<?php
session_start();
include("config.php");

//login values from login form
$matricNo = $_POST['matricNo']; 
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM student WHERE matricNo='$matricNo' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {	
	//check password hash
	$row = mysqli_fetch_assoc($result);
	if (password_verify($_POST['pwd'],$row['pwd'])) {
		$_SESSION["UID"] = $row["matricNo"];
        echo '<script type="text/javascript">		
            alert("Login successful. Welcome '.$matricNo.' !");
            window.location.replace("about_me.php");
		</script>';
    } else {
        echo '<script type="text/javascript">
            alert("Login error, student ID and password is incorrect.");
            window.location.replace("index.php");
        </script>';
    }	
} else {
    echo '<script type="text/javascript">
        alert("Login error, student ID '.$matricNo.' does not existed.");
        window.location.replace("index.php");
    </script>';
} 
mysqli_close($conn);
?>