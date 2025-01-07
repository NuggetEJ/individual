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
    <h2>Student Activity KPI</h2>
    <div style="padding:0 10px; width: 80%; margin: 0 auto; text-align: right;">
        <a href="my_kpi.php">Back to KPI Indicator Page </a>
    </div>
    <br>
    <div style="padding: 0 10px; width: 80%; margin: 0 auto;">	
    <table border="1" width="100%" id="projectable">
        <tr>
            <th colspan="7" style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #161A30; color: white;">Student Activity</th>
        </tr>
        <tr>
            <th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #3081D0; color: white;" width="10%">Indicator</th>
            <th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #3081D0; color: white;" width="10%">CGPA</th>
            <th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #3081D0; color: white;" width="10%">Faculty Level</th>
            <th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #3081D0; color: white;" width="10%">University Level</th>
            <th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #3081D0; color: white;" width="10%">National Level</th>
            <th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #3081D0; color: white;" width="10%">International Level</th>
            <th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #3081D0; color: white;" width="8%">Action</th>
        </tr>
        <tr>
            <td style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #A9A9A9;">Faculty KPI</td>
            <td style="text-align: center; background-color: #A9A9A9;">&ge; 3.00</td>
            <td style="text-align: center; background-color: #A9A9A9;">4</td>
            <td style="text-align: center; background-color: #A9A9A9;">4</td>
            <td style="text-align: center; background-color: #A9A9A9;">1</td>
            <td style="text-align: center; background-color: #A9A9A9;">1</td>
            <td style="text-align: center; background-color: #A9A9A9;"></td>
        </tr>
        <?php
        $matricNo = $_SESSION["UID"];
        //query the user and profile table for this user
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
            // Display the data in the table
            echo '<tr>';
            echo '<td style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #9EB8D9;">My KPI</td>';
            echo '<td style="text-align: center;">' . $cgpa . '</td>';
            echo '<td style="text-align: center;">' . $act_fac . '</td>';
            echo '<td style="text-align: center;">' . $act_uni . '</td>';
            echo '<td style="text-align: center;">' . $act_nat . '</td>';
            echo '<td style="text-align: center;">' . $act_inter . '</td>';
            echo '<td style="text-align: left;">';
            echo '<a href="edit_activitykpi.php?id=' . $kpi_id . ', ' . $matricNo . '">Edit | </a>';
            echo '<a href="delete_mykpi_activity.php?id=' . $kpi_id . ', ' . $matricNo . '" onclick="return confirm(\'Delete?\')">Delete</a>';
            echo '</td>';
            echo '</tr>';
        } else {
            // If no data is found, display empty cells
            echo '<tr>';
            echo '<td style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #9EB8D9;">My KPI</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td style="text-align: left;">';
            echo '<a href="edit_activitykpi.php">Add</a>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
        
        <?php
        $semesters = [1, 2];
        $years = [1, 2, 3, 4];

        foreach ($years as $year) {
            foreach ($semesters as $sem) {
                $sql = "SELECT * FROM activity_kpi WHERE matricNo = '$matricNo' AND year = '$year' AND sem = '$sem'";
                $result = mysqli_query($conn, $sql);

                // Check if there are rows in the result
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $cgpa = $row["cgpa"];
                    $faculty = $row["faculty"];
                    $university = $row["university"];
                    $national = $row["national"];
                    $international = $row["international"];

                    // Display the data in the table
                    echo '<tr>';
                    echo '<td style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #9EB8D9;">Sem ' . $sem . ' Year ' . $year . '</td>';
                    echo '<td style="text-align: center;">' . $cgpa . '</td>';
                    echo '<td style="text-align: center;">' . $faculty . '</td>';
                    echo '<td style="text-align: center;">' . $university . '</td>';
                    echo '<td style="text-align: center;">' . $national . '</td>';
                    echo '<td style="text-align: center;">' . $international . '</td>';
                    echo '<td style="text-align: left;">';
                    echo '<a href="edit_actkpi.php?sem=' . $sem . '&year=' . $year . '">Edit | </a>';
                    echo '<a href="delete_actkpi.php?sem=' . $sem . '&year=' . $year . '" onclick="return confirm(\'Delete?\')">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                } else {
                    // If no data is found, display empty cells
                    echo '<tr>';
                    echo '<td style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #9EB8D9;">Sem ' . $sem . ' Year ' . $year . '</td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td style="text-align: left;">';
                    echo '<a href="edit_actkpi.php?sem=' . $sem . '&year=' . $year . '">Add</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
        }
        ?>
	</table>
	</div>
    <br>
    <footer>
		<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
	</footer>
    <script src="js/script.js"></script>
</body>
</html>