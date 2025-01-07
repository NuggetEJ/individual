<?php
session_start();
include("config.php");

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["UID"])) {
    header("Location: index.php");
    exit();
}

// Check if the necessary parameters are provided in the URL
if (!isset($_GET['sem']) || !isset($_GET['year'])) {
    echo '<script type="text/javascript">
        alert("Invalid parameters for deletion.");
    </script>';
    exit();
}

$sem = $_GET['sem'];
$year = $_GET['year'];
$matricNo = $_SESSION["UID"];

// Perform the deletion
$sql = "DELETE FROM certification_kpi WHERE matricNo = '$matricNo' AND sem = '$sem' AND year = '$year'";
if (mysqli_query($conn, $sql)) {
    // Successfully deleted the record
    echo '<script type="text/javascript">
        alert("Certification data is successfully deleted!");
        window.location.replace("certification_kpi.php");
    </script>';
} else {
    // Handle the case where the deletion failed
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
