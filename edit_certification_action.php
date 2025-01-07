<?php
session_start();
include("config.php");

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["UID"])) {
    header("Location: index.php");
    exit();
}

// Retrieve data from the form
$sem = $_POST['sem'];
$year = $_POST['year'];
$matricNo = $_POST['matricNo'];
$certificate = $_POST['certificate'];

// Check if the data already exists in the database
$checkSql = "SELECT * FROM certification_kpi WHERE matricNo = '$matricNo' AND sem = '$sem' AND year = '$year'";
$result = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($result) > 0) {
    // Data already exists, update the record
    $updateSql = "UPDATE certification_kpi SET certificate='$certificate'
                  WHERE matricNo='$matricNo' AND sem='$sem' AND year='$year'";

    if (mysqli_query($conn, $updateSql)) {
        // Successfully updated the record
        echo '<script type="text/javascript">
            alert("Certification data is successfully updated!");
            window.location.replace("certification_kpi.php");
        </script>';
    } else {
        // Handle the case where the update failed
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Data does not exist, insert a new record
    $insertSql = "INSERT INTO certification_kpi (matricNo, sem, year, certificate) 
                  VALUES ('$matricNo', '$sem', '$year', '$certificate')";

    if (mysqli_query($conn, $insertSql)) {
        // Successfully inserted new data
        echo '<script type="text/javascript">
            alert("New certification data is successfully added!");
            window.location.replace("certification_kpi.php");
        </script>';
    } else {
        // Handle the case where the insertion failed
        echo "Error inserting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
