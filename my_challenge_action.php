<?PHP
session_start();
include('config.php');

//variables
$action="";
$id="";
$sem = "";
$year = "";
$challenge =" ";
$remark = "";

//for upload
$target_dir = "uploads/";
$target_file = "";
$uploadOk = 0;
$imageFileType = "";
$uploadfileName = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $challenge = trim($_POST["challenge"]);
    $plan = trim($_POST["plan"]);
    $remark = trim($_POST["remark"]);
    
    $filetmp = $_FILES["fileToUpload"];
    //file of the image/photo file
    $uploadfileName = $filetmp["name"];

    //Check if there is an image to be uploaded
    //IF no image
    if(isset($_FILES["fileToUpload"]) &&  $_FILES["fileToUpload"]["name"] == ""){
        $sql = "INSERT INTO challenge (matricNo, sem, year, challenge, plan, remark, img_path)
                VALUES ('" . $_SESSION["UID"] . "', '" . $sem . "', '". $year . "', '" . $challenge . "','" . $plan . "', '" . $remark . "', '" . $uploadfileName . "')";
        $status = insertTo_DBTable($conn, $sql);
        if ($status) {
            echo '<script type="text/javascript">
                alert("New challenge is successfully added!");
                window.location.replace("my_challenge.php");
            </script>';           
        } else {
            echo '<script type="text/javascript">
                window.location.replace("my_challenge.php");
            </script>';
        }   
    }
    //IF there is image
    else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        //Variable to determine for image upload is OK
        $uploadOk = 1;        
        $filetmp = $_FILES["fileToUpload"];

        //file of the image/photo file
        $uploadfileName = $filetmp["name"];
                 
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo '<script type="text/javascript">
                alert("ERROR: Sorry, image file '.$uploadfileName.' already exists.");
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
        
        // Allow only these file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo '<script type="text/javascript">
                alert("ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            </script>';
            $uploadOk = 0;
        } 

        //If uploadOk, then try add to database first 
        //uploadOK=1 if there is image to be uploaded, filename not exists, file size is ok and format ok     
        if($uploadOk){
            $sql = "INSERT INTO challenge (matricNo, sem, year, challenge, plan, remark, img_path)
            VALUES ('" . $_SESSION["UID"] . "', '" . $sem . "', '". $year . "', '" . $challenge . "','" . $plan . "', '" . $remark . "', '" . $uploadfileName . "')";
            $status = insertTo_DBTable($conn, $sql);
            if ($status) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //Image file successfully uploaded 
                    echo '<script type="text/javascript">
                        alert("New challenge with image file is successfully added!");
                        window.location.replace("my_challenge.php");
                    </script>';     
                } 
                else{
                    //There is an error while uploading image      
                    echo '<script type="text/javascript">
                        alert("Sorry, there was an error uploading your file.");
                        window.history.back();
                    </script>';          
                }
            } 
            else {
                echo '<script type="text/javascript">
                    window.history.back();
                </script>';
            }
        }
        else{            
            echo '<script type="text/javascript">
                window.history.back();
            </script>';
        }
    }    
}

//close db connection
mysqli_close($conn);

//Function to insert data to database table
function insertTo_DBTable($conn, $sql){
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>
