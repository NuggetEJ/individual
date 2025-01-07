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
</head>
<body>
	<div class="header">
        <h1>My Activities Search Results</h1>
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
    $search = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = $_POST["search"]; 
    }	
    ?>

    <h2>Search Result: <?=$search?></h2>

	<div style="padding:0 10px;">
    <div style="text-align: right; padding:10px;">
        <form action="my_activities_search.php" method="post">
            <input type="text" placeholder="Search based on activity record name..." name="search">
            <input type="submit" value="Search">
        </form> 
    </div>
	<table border="1" width="100%" id="projectable">
		<tr>
			<th style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #619196; color: white;" width="5%">No</th>
			<th style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #619196; color: white;" width="10%">Sem & Year</th>
			<th style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #619196; color: white;" width="30%">Name of Activities/Club/Association/Competition</th>
			<th style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #619196; color: white;" width="15%">Remark</th>
			<th style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #619196; color: white;" width="10%">Action</th>
		</tr>
		<?php
			if ($search!="") {
				$search = $_POST["search"]; 
				$matricNo = $_SESSION["UID"];
				
				// Modify the SQL query to include search functionality
				$sql = "SELECT * FROM activity WHERE matricNo = '$matricNo' AND activity LIKE '%$search%'";
				$result = mysqli_query($conn, $sql);
				
				if (mysqli_num_rows($result) > 0) {
					// output data of each row
					$numrow=1;
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $numrow . "</td><td>". $row["sem"] . " " . $row["year"]. "</td><td>" . $row["activity"] . "</td><td>" . $row["remark"] . "</td>";
						echo '<td> <a href="my_activities_edit.php?id=' . $row["actID"] . '">Edit</a>&nbsp;|&nbsp;';
						echo '<a href="my_activities_delete.php?id=' . $row["actID"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
						echo "</tr>" . "\n\t\t";
						$numrow++;
					}
				} else {
					echo '<tr><td colspan="5">0 results</td></tr>';
				} 
				mysqli_close($conn);
			}
			else{
				echo "Search query is empty<br>";
			}
		?>
	</table>
	</div>
	<div style="text-align: right; padding:10px;">
		<a href='my_activities.php'>Display All List of Activities</a>
	</div>
	<footer>
		<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
	</footer>
	<script src="js/script.js"></script>
</body>
</html>
