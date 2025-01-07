<!--login section-->
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
    <form class="modal-content animate" action="login_action.php" method="post">
        <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <img src="img/fki.jfif" alt="fki" class="avatar">
        </div>
            
        <div class="container">
        <label for="matricNo"><b>Student ID</b></label>
        <input type="text" placeholder="Enter Your Student ID (Eg: BI21110372)" id="matricNo" name="matricNo" maxlength="10" required>

        <label for="pwd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" id="pwd" name="pwd" minlength="8" required>
            
        <button type="submit">Login</button>
        <small><i>Make sure your Student ID follow the right format and no space (Eg: BI21110372).</i></small>
        </div>

        <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="forgot_password.php">password?</a></span>
        </div>
    </form>
</div>
