<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<title>My FCI Study KPI System</title>
</head>
<body>
	<div class="header">
        <h1>My Activities</h1>
	</div>
    
    <nav class="topnav" id="myTopnav">
		<a href="about_me.php">About Me</a>
		<a href="my_kpi.php">KPI Indicator</a>
		<a href="my_activities.php"  class="active">List of Activities</a>
		<a href="my_challenge.php">Challenge and Future Plan</a>

		<?php 
		// Check if the user is not logged in, redirect to login page
		if (!isset($_SESSION["UID"])) {
			header("Location: index.php");
			exit();
		}
		else{
			echo '<b> '. $_SESSION["UID"] . '</b> <a href="logout.php"> Logout </a>';		
		}			
		?>
		<a href="javascript:void(0);" class="icon" onclick="myFunction()">
		<i class="fa fa-bars"></i></a>
	</nav>
    
<?php
	if(isset($_GET['id'])) {
		$actID = $_GET['id'];
		$matricNo = $_SESSION["UID"];

		// Fetch the specific activity details from the database
		$sql = "SELECT * FROM activity WHERE actID = '$actID'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			// Display the form with the activity details for editing
?>
		<div style="padding:0 10px;" id="challengeDiv">
            <h2>Edit Activities/Club/Association/Competition</h2>
            <form method="POST" action="my_activities_edit_action.php" id="myForm">
			<table border="1" id="myTable">
                <input type="hidden" name="actID" value="<?php echo $row['actID']; ?>">
				<tr>
				<td>Semester*</td>
				<td width="1px">:</td>
				<td>
				<select name="sem" required>
                    <option value="1" <?php if($row['sem'] == 1) echo 'selected'; ?>>1</option>
                    <option value="2" <?php if($row['sem'] == 2) echo 'selected'; ?>>2</option>
                </select>
				</td>
				</tr>
                <tr>
				<td>Year*</td>
				<td>:</td>
				<td>
					<input type="text" name="year" value="<?php echo $row['year']; ?>" maxlength="9" required>                             
				</td>
				</tr>
                <tr>
				<td>Name of Activities/Club/Association/Competition*</td>
				<td>:</td>
				<td>
					<textarea name="activity" rows="4" cols="20" required><?php echo $row['activity']; ?></textarea>
				</td>
				</tr>
				<tr>
				<td>Remark</td>
				<td>:</td>
				<td>
					<textarea name="remark" rows="4" cols="20"><?php echo $row['remark']; ?></textarea><br><br>
				</td>
				</tr>
				<tr>
					<td colspan="3" align="right"> 
					<input type="submit" value="Submit" name="B1">                
					<input type="reset" value="Reset" name="B2">
					</td>
				</tr>
			</table>
            </form>
		</div>
<?php
    } else {
		echo '<script type="text/javascript">
            alert("Activity not found!");
            window.location.replace("my_activities.php");
        </script>';
    }

    mysqli_close($conn);
} else {
	echo '<script type="text/javascript">
		alert("Invalid activity ID!");
		window.location.replace("my_activities.php");
	</script>';
}
?>
	<footer>
		<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
	</footer>
	<script src="js/script.js"></script>
</body>
</html>