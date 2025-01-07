<!--edit profile section-->
<center><button onclick="document.getElementById('id03').style.display='block'" style="width:auto;">Edit My Personal Details</button></center>

<div id="id03" class="modal">
<form class="modal-content animate" action="edit_profile_action.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
		<span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
		<h2>Edit Profile</h2>
	</div>
        <div class="container">
            <label for="matricNo">Student ID:</label><br>
            <input type="text" placeholder="<?=$matricNo?>" readonly><br><br>

            <label for="studEmail">Email:</label><br>
            <input type="text" placeholder="<?=$studEmail?>" readonly><br><br>

            <label for="studName">Name:</label><br>
            <input type="text" placeholder="Enter Your Name" id="studName" name="studName" value="<?= $studName ?>" required><br><br>

            <label for="intakeBatch">Intake Batch:</label><br>
            <input type="text" placeholder="Enter Your Intake Batch (Eg: 2021)" id="intakeBatch" name="intakeBatch" maxlength="4" minlength="4" value="<?= $intakeBatch ?>" required><br><br>

            <label for="phoneNo">Phone Number:</label><br>
            <input type="text" placeholder="Enter Your Phone Number" id="phoneNo" name="phoneNo" maxlength="12" value="<?= $phoneNo ?>" required><br><br>

            <label for="mentorName">Mentor Name:</label><br>
            <input type="text" placeholder="Enter Your Mentor Name" id="mentorName" name="mentorName" value="<?= $mentorName ?>" required><br><br>

            <label for="stateOrigin">State of Origin:</label><br>
            <input type="text" placeholder="Enter Your State of Origin" id="stateOrigin" name="stateOrigin" value="<?= $stateOrigin ?>" required><br><br>

            <label for="address">Home Address:</label><br>
            <input type="text" placeholder="Enter Your Home Address" id="address" name="address" value="<?= $address ?>" required><br><br>

            <label for="motto">Study Motto:</label><br>
            <input type="text" placeholder="Enter Your Study Motto" id="motto" name="motto" value="<?= $motto ?>" required><br><br>

            <label for="program">Choose Your Program:</label>
            <select size="1" name="program">
                <option value="" <?php echo ($program == '') ? 'selected' : ''; ?> disabled >Select Program</option>   
                <option <?php echo ($program == 'Software Engineering') ? 'selected' : ''; ?>>Software Engineering</option>
                <option <?php echo ($program == 'Network Engineering') ? 'selected' : ''; ?>>Network Engineering</option>
                <option <?php echo ($program == 'Data Science') ? 'selected' : ''; ?>>Data Science</option>
            </select><br><br>
            
            <label for="profilePic">Profile Picture:</label>
            <input type="file" id="profilePic" name="profilePic" value="<?= $profilePic ?>"><br><br>

            <button type="submit">Save Changes</button>
        </div>

        <div class="container" style="background-color:#f1f1f1">
		<button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
		</div>
</form>
</div>
