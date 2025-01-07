<?php
session_start();
include("config.php");

if (!isset($_SESSION["UID"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['actID'], $_POST['sem'], $_POST['year'], $_POST['activity'])) {
        $actID = $_POST['actID'];
        $sem = $_POST['sem'];
        $year = $_POST['year'];
        $activity = $_POST['activity'];
        $remark = $_POST['remark'];

        // Update the activity details in the database
        $update_query = "UPDATE activity SET sem = '$sem', year = '$year', activity = '$activity', remark = '$remark' WHERE actID = '$actID'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            // Redirect to the activities list page after successful update
            echo '<script type="text/javascript">
                alert("Data successfully updated!");
                window.location.replace("my_activities.php");
            </script>';
        } else {
            echo "Error updating activity: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo '<script type="text/javascript">
            alert("Invalid data received for update!");
            window.location.replace("my_activities.php");
        </script>';
    }
} else {
    echo '<script type="text/javascript">
        alert("Invalid request method!");
        window.location.replace("my_activities.php");
    </script>';
}
?>
