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
    
    <h2>List of Activities/Club/Association/Competition</h2>
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
			$matricNo = $_SESSION["UID"];
			$sql = "SELECT * FROM activity WHERE matricNo = '$matricNo'";
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
			} 
			else {
				echo '<tr><td colspan="5">0 results</td></tr>';
			} 
		mysqli_close($conn); 
		?>
	</table>
	</div>
    <br>
	<div style="padding:0 10px;" id="challengeDiv">
	<h3 align="center">Add Activities/Club/Association/Competition</h3>
	<p align="center">Required field with mark*</p>

	<form method="POST" action="my_activities_action.php" enctype="multipart/form-data" id="myForm">
		<table border="1" id="myTable">
            <tr>
				<td>Semester*</td>
				<td width="1px">:</td>
				<td>
					<select size="1" name="sem" required>                        
                        <option value="">&nbsp;</option>
                        <option value="1">1</option>;                           
                        <option value="2">2</option>;                        
					</select>
				</td>
			</tr>
			<tr>
				<td>Year*</td>
				<td>:</td>
				<td>
                    <input type="text" name="year" size="5" maxlength="9" required>                                    
				</td>
			</tr>
			<tr>
				<td>Name of Activities/Club/Association/Competition*</td>
				<td>:</td>
				<td>
					<textarea rows="4" name="activity" cols="20" required></textarea>
				</td>
			</tr>
			<tr>
				<td>Remark</td>
				<td>:</td>
				<td>
					<textarea rows="4" name="remark" cols="20"></textarea>
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
<p></p>
<footer>
	<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
</footer>
<script src="js/script.js"></script>
</body>
</html>