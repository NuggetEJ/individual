<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricNo = $_SESSION["UID"];

    $sem = $_POST['sem'];
    $year = $_POST['year'];
    $activity = $_POST['activity'];
    $remark = $_POST['remark'];

    // Inserting data into the database
    $insert_query = "INSERT INTO activity (matricNo, sem, year, activity, remark) VALUES ('$matricNo', '$sem', '$year', '$activity', '$remark')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
        // Successful insertion
        echo '<script type="text/javascript">
            alert("New activity is successfully added!");
            window.location.replace("my_activities.php");
        </script>';
    } else {
        // If insertion fails, handle the error (you might want to log this)
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If the form was not submitted properly or if the button name 'B1' wasn't set
    echo '<script type="text/javascript">
        alert("Form submission error!");
        window.history.back();
    </script>';
}

mysqli_close($conn);
?>