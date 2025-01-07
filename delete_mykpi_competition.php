<?php
session_start();
include("config.php");

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["UID"])) {
    header("Location: index.php");
    exit();
}

// Check if the necessary parameters are provided in the URL
if (!isset($_GET['id'])) {
    echo '<script type="text/javascript">
        alert("Invalid parameters for deletion.");
    </script>';
    exit();
}

$kpi_id = $_GET['id'];
$matricNo = $_SESSION["UID"];

// Perform the update to set columns to NULL
$sql = "UPDATE mykpi SET comp_fac = NULL, comp_uni = NULL, comp_nat = NULL, comp_inter = NULL
        WHERE matricNo = '$matricNo' AND kpi_id = '$kpi_id'";

if (mysqli_query($conn, $sql)) {
    // Successfully updated the record
    echo '<script type="text/javascript">
        alert("My KPI competition data is set to NULL!");
        window.location.replace("competition_kpi.php");
    </script>';
} else {
    // Handle the case where the update failed
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
