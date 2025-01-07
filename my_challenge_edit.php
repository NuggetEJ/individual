<?php
session_start(); // Start the session
include("config.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ch_id = $_GET['id'];

    // Fetch challenge details based on the provided ID
    $sql = "SELECT * FROM challenge WHERE ch_id = $ch_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $sem = $row['sem'];
        $year = $row['year'];
        $challenge = $row['challenge'];
        $plan = $row['plan'];
        $remark = $row['remark'];
        $img_path = $row['img_path'];
    } else {
        echo '<script type="text/javascript">
            alert("Challenge not found!");
        </script>'; 
        exit();
        
    }
} else {
    echo '<script type="text/javascript">
        alert("Invalid request!");
    </script>'; 
    exit();
}
mysqli_close($conn);
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
        <h1>My Challenge</h1>
    </div>
    
    <nav class="topnav" id="myTopnav">
		<a href="about_me.php">About Me</a>
		<a href="my_kpi.php">KPI Indicator</a>
		<a href="my_activities.php">List of Activities</a>
		<a href="my_challenge.php" class="active">Challenge and Future Plan</a>

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
    
    <div style="padding:0 10px;" id="challengeDiv">
        <h3 align="center">Edit Challenge and Plan</h3>
        <p align="center">Required field with mark*</p>
        
        <form method="POST" action="my_challenge_edit_action.php" id="myForm" enctype="multipart/form-data">
            <!--hidden value: id to be submitted to action page-->
            <input type="hidden" name="ch_id" value="<?php echo $ch_id; ?>">
            <table border="1" id="myTable"> 
                <tr>
                <td>Semester*</td>
                <td width="1px">:</td>
                <td>
                <select size="1" name="sem" required> 
                <option value="">&nbsp;</option>
                
                <?php
                    if($sem=="1")
                    echo '<option value="1" selected>1</option>';
                    else
                    echo '<option value="1">1</option>';
                    if($sem=="2")
                    echo '<option value="2" selected>2</option>';
                    else
                    echo '<option value="2">2</option>';
                ?>

                </select>
                </td>
                </tr>
                <tr>
                <td>Year*</td>
                <td>:</td>
                <td>
                <?php
                if($year!=""){
                    echo '<input type="text" name="year" size="5" value="' . $year . '" required>';
                }
                else {
                    ?>
                        <input type="text" name="year" size="5" maxlength="9" required>
                    <?php
                }
                ?> 
                </td>
                </tr>
                <tr>
                <td>Challenge*</td>
                <td>:</td>
                <td>
                <textarea rows="4" name="challenge" cols="20" required><?php echo $challenge;?></textarea>
                </td>
                </tr>
                <tr>
                <td>Plan*</td>
                <td>:</td>
                <td>
                <textarea rows="4" name="plan" cols="20" required><?php echo $plan;?></textarea>
                </td>
                </tr>
                <tr>
                <td>Remark</td>
                <td>:</td>
                <td>
                <textarea rows="4" name="remark" cols="20"><?php echo $remark;?></textarea>
                </td>
                </tr>
                <tr>
                <td>Photo</td>
                <td>:</td>
                <td>
                <input type="text" disabled value="<?=$img_path;?>">
                </td>
                </tr>
                <tr>
                <td>Upload photo</td>
                <td>:</td>
                <td>
                Max size: 5 MB<br>
                <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
                </td>
                </tr>
                <tr>
                <td colspan="3" align="right">
                <input type="submit" value="Submit" name="B1"> 
                <input type="reset" value="Reset" name="B2" onclick="resetForm()">
                <input type="button" value="Clear" name="B3" onclick="clearForm()">
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