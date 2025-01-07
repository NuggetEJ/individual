<?php
session_start();
include("config.php");

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["UID"])) {
    header("Location: index.php");
    exit();
}

// Retrieve data from the form
$matricNo = $_POST['matricNo'];
$kpi_id = $_POST["kpi_id"];
$cgpa = $_POST["cgpa"];
$act_fac = $_POST["act_fac"];
$act_uni = $_POST["act_uni"];
$act_nat = $_POST["act_nat"];
$act_inter = $_POST["act_inter"];

// Check if the data already exists in the database
$checkSql = "SELECT cgpa, act_fac, act_uni, act_nat, act_inter FROM mykpi WHERE matricNo = '$matricNo' AND kpi_id = '$kpi_id'";
$result = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($result) > 0) {
    // Data already exists, update the record
    $updateSql = "UPDATE mykpi SET cgpa='$cgpa', act_fac='$act_fac', act_uni='$act_uni', 
                  act_nat='$act_nat', act_inter='$act_inter' 
                  WHERE matricNo='$matricNo' AND kpi_id = '$kpi_id'";

    if (mysqli_query($conn, $updateSql)) {
        // Successfully updated the record
        echo '<script type="text/javascript">
            alert("My KPI data is successfully updated!");
            window.location.replace("activity_kpi.php");
        </script>';
    } else {
        // Handle the case where the update failed
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Data does not exist, insert a new record
    $insertSql = "INSERT INTO mykpi (matricNo, cgpa, act_fac, act_uni, act_nat, act_inter) 
                  VALUES ('$matricNo', '$cgpa', '$act_fac', '$act_uni', '$act_nat', '$act_inter')";

    if (mysqli_query($conn, $insertSql)) {
        // Successfully inserted new data
        echo '<script type="text/javascript">
            alert("New My KPI data is successfully added!");
            window.location.replace("activity_kpi.php");
        </script>';
    } else {
        // Handle the case where the insertion failed
        echo "Error inserting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
