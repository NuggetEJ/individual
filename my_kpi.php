<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<title>My FCI Study KPI System</title>

    <style>
        a.interesting-link {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #3081D0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        a.interesting-link:hover {
            background-color: #245682;
        }
    </style>
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
    
    <h2>KPI Indicator</h2>
    <div align="center">
        <a href="activity_kpi.php" class="interesting-link">Student Activity KPI</a>
        <a href="competition_kpi.php" class="interesting-link">Competition KPI</a>
        <a href="certification_kpi.php" class="interesting-link">Certification KPI</a>
    </div>
    <br>
    <footer>
		<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
	</footer>
    <script src="js/script.js"></script>
</body>
</html>