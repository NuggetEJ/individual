<?php
session_start();
include("config.php");

// Retrieve parameters from the URL
$matricNo = $_SESSION["UID"];

// Fetch existing data from the database based on the parameters
$sql = "SELECT kpi_id, cgpa, act_fac, act_uni, act_nat, act_inter FROM mykpi WHERE matricNo = '$matricNo'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $kpi_id = $row["kpi_id"];
    $cgpa = $row["cgpa"];
    $act_fac = $row["act_fac"];
    $act_uni = $row["act_uni"];
    $act_nat = $row["act_nat"];
    $act_inter = $row["act_inter"];
} 

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
        <h1>My KPI Indicator</h1>
    </div>
    <nav class="topnav" id="myTopnav">
		<a href="about_me.php">About Me</a>
		<a href="my_kpi.php" class="active">KPI Indicator</a>
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

    <div style="padding:0 10px; width: 70%; margin: 0 auto;" id="challengeDiv">
    <h2>Add / Edit My KPI</h2>
    <form method="post" action="edit_activitykpi_action.php" id="myForm">
    <table border="1" id="myTable">
        <!-- Include hidden fields for sem, year, and matricNo -->
        <input type="hidden" name="matricNo" value="<?php echo $matricNo; ?>" />
        <input type="hidden" name="kpi_id" value="<?php echo $kpi_id; ?>" />
        <tr>
            <td>CGPA</td>
            <td width="1px">:</td>
            <td><input type="number" step="0.01" id="cgpa" name="cgpa" value="<?php echo $cgpa; ?>" min="0.00" max="4.00"></td>
        </tr>
        <tr>
            <td>Faculty Level</td>
            <td width="1px">:</td>
            <td><input type="number" id="act_fac" name="act_fac" value="<?php echo $act_fac; ?>" min="0"></td>
        </tr>
        <tr>
            <td>University Level</td>
            <td width="1px">:</td>
            <td><input type="number" id="act_uni" name="act_uni" value="<?php echo $act_uni; ?>" min="0"></td>
        </tr>
        <tr>
            <td>National Level</td>
            <td width="1px">:</td>
            <td><input type="number" id="act_nat" name="act_nat" value="<?php echo $act_nat; ?>" min="0"></td>
        </tr>
        <tr>
            <td>International Level</td>
            <td width="1px">:</td>
            <td><input type="number" id="act_inter" name="act_inter" value="<?php echo $act_inter; ?>" min="0"></td>
        </tr>
        <tr>
            <td colspan="3" align="right"> 
            <input type="submit" value="Submit" name="B1">                
            <input type="reset" value="Reset" name="B2">
            </td>
        </tr>
    </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>