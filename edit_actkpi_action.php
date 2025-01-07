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
$cgpa = $_POST['cgpa'];
$faculty = $_POST['faculty'];
$university = $_POST['university'];
$national = $_POST['national'];
$international = $_POST['international'];

// Check if the data already exists in the database
$checkSql = "SELECT * FROM activity_kpi WHERE matricNo = '$matricNo' AND sem = '$sem' AND year = '$year'";
$result = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($result) > 0) {
    // Data already exists, update the record
    $updateSql = "UPDATE activity_kpi SET cgpa='$cgpa', faculty='$faculty', university='$university', 
                  national='$national', international='$international' 
                  WHERE matricNo='$matricNo' AND sem='$sem' AND year='$year'";

    if (mysqli_query($conn, $updateSql)) {
        // Successfully updated the record
        echo '<script type="text/javascript">
            alert("Student activity data is successfully updated!");
            window.location.replace("activity_kpi.php");
        </script>';
    } else {
        // Handle the case where the update failed
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Data does not exist, insert a new record
    $insertSql = "INSERT INTO activity_kpi (matricNo, sem, year, cgpa, faculty, university, national, international) 
                  VALUES ('$matricNo', '$sem', '$year', '$cgpa', '$faculty', '$university', '$national', '$international')";

    if (mysqli_query($conn, $insertSql)) {
        // Successfully inserted new data
        echo '<script type="text/javascript">
            alert("New student activity data is successfully added!");
            window.location.replace("activity_kpi.php");
        </script>';
    } else {
        // Handle the case where the insertion failed
        echo "Error inserting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
