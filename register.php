<!-- registration section -->
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register</button>

<div id="id02" class="modal">
	<form class="modal-content animate" action="register_action.php" method="post">
	<div class="imgcontainer">
		<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
		<img src="img/fki.jfif" alt="fki" class="avatar">
		</div>
			
		<div class="container">
		<label for="studName"><b>Student Name</b></label>
		<input type="text" placeholder="Enter Your Name" id="studName" name="studName" required>

		<label for="matricNo"><b>Student ID</b></label>
		<input type="text" placeholder="Enter Your Student ID (Eg: BI21110372)" id="matricNo" name="matricNo" maxlength="10" minlength="10" required>
		<small><i>Make sure your Student ID follow the right format & all UPPERCASE (Eg: BI21110372).</i></small><br><br>
		
		<label for="studEmail"><b>Student Email</b></label><br>
		<input type="email" placeholder="Enter Your Student Email" id="studEmail" name="studEmail" style="width:99%;height:30px;" required><br><br>

		<label for="pwd"><b>Password</b></label>
		<input type="password" placeholder="Enter Your Password" id="pwd" name="pwd" minlength="8" required>

		<label for="pwd"><b>Confirm Password</b></label>
		<input type="password" placeholder="Confirm Your Password" id="confirmPwd" name="confirmPwd" minlength="8" required>

		<button type="submit">Register</button>
		</div>

		<div class="container" style="background-color:#f1f1f1">
		<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
		</div>
	</form>
</div>