<?php
session_start();
include("config.php");

// Retrieve parameters from the URL
$matricNo = $_SESSION["UID"];

// Fetch existing data from the database based on the parameters
$sql = "SELECT kpi_id, comp_fac, comp_uni, comp_nat, comp_inter FROM mykpi WHERE matricNo = '$matricNo'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $kpi_id = $row["kpi_id"];
    $comp_fac = $row["comp_fac"];
    $comp_uni = $row["comp_uni"];
    $comp_nat = $row["comp_nat"];
    $comp_inter = $row["comp_inter"];
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
    <form method="post" action="edit_competitionkpi_action.php" id="myForm">
    <table border="1" id="myTable">
        <!-- Include hidden fields for sem, year, and matricNo -->
        <input type="hidden" name="matricNo" value="<?php echo $matricNo; ?>" />
        <input type="hidden" name="kpi_id" value="<?php echo $kpi_id; ?>" />
        <tr>
            <td>Faculty Level</td>
            <td width="1px">:</td>
            <td><input type="number" id="comp_fac" name="comp_fac" value="<?php echo $comp_fac; ?>" min="0"></td>
        </tr>
        <tr>
            <td>University Level</td>
            <td width="1px">:</td>
            <td><input type="number" id="comp_uni" name="comp_uni" value="<?php echo $comp_uni; ?>" min="0"></td>
        </tr>
        <tr>
            <td>National Level</td>
            <td width="1px">:</td>
            <td><input type="number" id="comp_nat" name="comp_nat" value="<?php echo $comp_nat; ?>" min="0"></td>
        </tr>
        <tr>
            <td>International Level</td>
            <td width="1px">:</td>
            <td><input type="number" id="comp_inter" name="comp_inter" value="<?php echo $comp_inter; ?>" min="0"></td>
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