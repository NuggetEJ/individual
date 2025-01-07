<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricNo = $_SESSION["UID"];
    
    $studName = mysqli_real_escape_string($conn, $_POST['studName']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $intakeBatch = mysqli_real_escape_string($conn, $_POST['intakeBatch']);
    $phoneNo = mysqli_real_escape_string($conn, $_POST['phoneNo']);
    $mentorName = mysqli_real_escape_string($conn, $_POST['mentorName']);
    $stateOrigin = mysqli_real_escape_string($conn, $_POST['stateOrigin']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $motto = mysqli_real_escape_string($conn, $_POST['motto']);

    // Handle profile picture upload
    $targetDir = "profile/"; // Directory where profile pictures will be stored
    $uploadOk = 1;
    $profilePic = ''; // Initialize profile picture variable

    if (!empty($_FILES["profilePic"]["name"])) {
        // Image file is provided
        $targetFile = $targetDir . basename($_FILES["profilePic"]["name"]);
        
        // Check if image file is a valid image
        $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo '<script type="text/javascript">
                alert("File is not an image.");
            </script>';
            $uploadOk = 0;
        }

        // Check file size (updated to 5 MB)
        if ($_FILES["profilePic"]["size"] > 5000000) {
            echo '<script type="text/javascript">
                alert("Sorry, your file is too large. Maximum file size is 5MB only.");
            </script>';
            $uploadOk = 0;
        }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo '<script type="text/javascript">
                alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            </script>';
            $uploadOk = 0;
        }

        // If all checks pass, move the uploaded file to the directory
        if ($uploadOk == 1 && move_uploaded_file($_FILES["profilePic"]["tmp_name"], $targetFile)) {
            $profilePic = $targetFile;
        }
    }

    // Get the current profile picture path from the database
    $sql_select_profile_pic = "SELECT profilePic FROM student WHERE matricNo = '$matricNo'";
    $result_select_profile_pic = mysqli_query($conn, $sql_select_profile_pic);

    if ($result_select_profile_pic && mysqli_num_rows($result_select_profile_pic) > 0) {
        $row = mysqli_fetch_assoc($result_select_profile_pic);
        $currentProfilePic = $row['profilePic'];

        // If a new profile picture is uploaded and successfully moved, update the path in the database
        if ($uploadOk == 1 && !empty($profilePic)) {
            // Attempt to delete the previous profile picture if it exists
            if (!empty($currentProfilePic) && file_exists($currentProfilePic)) {
                unlink($currentProfilePic); // Delete the previous profile picture from the server
            }

            // Update the profile picture path in the database
            $sql_update_pic = "UPDATE student SET profilePic = '$profilePic' WHERE matricNo = '$matricNo'";
            if (!mysqli_query($conn, $sql_update_pic)) {
                echo "Error updating profile picture: " . mysqli_error($conn);
            }
        }
    }

    // Perform SQL UPDATE queries to update user information in the database
    $sql_update_profile = "UPDATE student SET studName = '$studName', program = '$program', 
        intakeBatch = '$intakeBatch', phoneNo = '$phoneNo', mentorName = '$mentorName', stateOrigin = '$stateOrigin', 
        address = '$address', motto = '$motto' WHERE matricNo = '$matricNo'";

    if (mysqli_query($conn, $sql_update_profile)) {
        echo '<script type="text/javascript">
            alert("Data is successfully edited!");
            window.location.replace("about_me.php");
        </script>';
    } else {
        // Handle update failure (e.g., display an error message)
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo '<script type="text/javascript">
        alert("Form submission error. Please try again.");
        window.location.replace("about_me.php");
    </script>';
}
?>