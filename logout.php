<?php
session_start();
if(isset($_SESSION["UID"])){
	$loggedOutUID = $_SESSION["UID"]; // Storing UID before unsetting session variable
	unset($_SESSION["UID"]);

	echo '<script type="text/javascript">
		alert("Logout Successful, ' . $loggedOutUID . '!");
		window.location.replace("index.php");
	</script>';
}	
?>