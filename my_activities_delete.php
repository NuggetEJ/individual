<?php
session_start();
include("config.php");

// This action is called when the Delete link is clicked
if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];

    // Delete the record from the database
    $deleteSQL = "DELETE FROM activity WHERE actID = $id";
    if (mysqli_query($conn, $deleteSQL)) {
        echo '<script type="text/javascript">
            alert("Activity record has been successfully deleted from the database.");
            window.location.replace("my_activities.php");
        </script>';
    } else {
        echo '<script type="text/javascript">
            alert("Error deleting data: ' . mysqli_error($conn) . '");
            window.location.replace("my_activities.php");
        </script>';   
    }
} else {
    echo '<script type="text/javascript">
            alert("No ID provided for deletion.");
            window.location.replace("my_activities.php");
        </script>';
}
mysqli_close($conn);
?>
