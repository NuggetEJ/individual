<?php
session_start(); // Start the session
include("config.php");
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<title>My FCI Study KPI System</title>
</head>
<body>
	<div class="header">
        <h1>About Me Hi</h1>
	</div>
    
    <nav class="topnav" id="myTopnav">
		<a href="about_me.php" class="active">About Me</a>
		<a href="my_kpi.php">KPI Indicator</a>
		<a href="my_activities.php">List of Activities</a>
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
    $matricNo = $_SESSION["UID"];
    //query the user and profile table for this user
    $sql = "SELECT * FROM student WHERE matricNo = '$matricNo'";
    $result = mysqli_query($conn, $sql);
    $defaultProfilePic = 'img/photo.png';

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $studName = $row["studName"];
        $studEmail = $row["studEmail"];
		$program = $row["program"];
        $intakeBatch = $row["intakeBatch"];
        $phoneNo = $row["phoneNo"];
        $mentorName = $row["mentorName"];
		$stateOrigin = $row["stateOrigin"];
        $address = $row["address"];
        $motto = $row["motto"];
		$profilePic = $row["profilePic"]; // Assuming profilePic contains the URL or file path to the image
		
		// Check if profilePic is empty or null; if so, assign the default profile picture
		$profilePic = !empty($profilePic) ? $profilePic : $defaultProfilePic;
    }
    ?>
	<h2><b>My Portfolio</b></h2>
	<div class="row">
        <div class="col-left">
            <img class="image" src="<?=$profilePic?>" alt="Profile Photo">
        </div>
		
        <div class="col-right"> 
		<table border="1" width="100%" style="border-collapse: collapse;" class="mydetails">
			<tr>
				<td width="164" height="30">Name</td>
				<td><?=$studName?></td>
			</tr>
			<tr>
				<td width="164" height="30">Matric No.</td>
				<td><?=$matricNo?></td>
			</tr>
			<tr>
				<td width="164" height="30">Email</td>
				<td><?=$studEmail?></td>
			</tr>
			<tr>
				<td width="164" height="30">Program</td>
				<td><?=$program?></td>
			</tr>
			<tr>
				<td width="164" height="30">Intake Batch</td>
				<td><?=$intakeBatch?></td>
			</tr>
			<tr>
				<td width="164" height="30">Phone Number</td>
				<td><?=$phoneNo?></td>
			</tr>
			<tr>
				<td width="164" height="30">Mentor Name</td>
				<td><?=$mentorName?></td>
			</tr>
			<tr>
				<td width="164" height="30">State of Origin</td>
				<td><?=$stateOrigin?></td>
			</tr>
			<tr>
				<td width="164" height="30">Home Address</td>
				<td><?=$address?></td>
			</tr>
		</table>
		<p><b>My Study Motto</b></p>
		<table border="1" align="center" width="100%" style="border-collapse: collapse" class="mydetails">
			<tr>
				<td width="164" height="30" align="center">
					<?php
					if($motto==""){
						echo "&nbsp;";
					}
					else{
						echo $motto;
					}
					?>
				</td>
			</tr>
		</table>
			<br><?php include 'edit_profile.php'; ?><br>
        </div>
    </div>
	<footer>
		<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
	</footer>
	<script src="js/script.js"></script>
</body>
</html>
