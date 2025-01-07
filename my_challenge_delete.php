<?PHP
include('config.php');
//this action is called when the Delete link is clicked
if(isset($_GET["id"]) && $_GET["id"] != ""){
    $id = $_GET["id"];

    //Cari image filename before deleting the record
    $sqlSelect = "SELECT img_path FROM challenge WHERE ch_id = " . $id;
    $result = mysqli_query($conn, $sqlSelect);   
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $imageFileName = $row['img_path'];

        // Delete the image file if it exists
        if ($imageFileName) {
            $imagePath = 'uploads/' . $imageFileName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
    
    $sql = "DELETE FROM challenge WHERE ch_id=" . $id . " ";
    if (mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript">
            alert("Challenge record deleted successfully.");
            window.location.replace("my_challenge.php");
        </script>'; 
     } else {
        echo '<script type="text/javascript">
            alert("Error deleting record: ' . mysqli_error($conn) . '");
            window.location.replace("my_challenge.php");
        </script>'; 
    }
}
mysqli_close($conn);
?>