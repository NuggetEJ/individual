<!-- forgot_password.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .container{
            padding: 30px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Forgot Password</h2>
    <p>Please enter your Student ID to reset your password.</p>
    <form action="reset_password.php" method="post">
        <label for="matricNo"><b>Student ID</b></label>
        <input type="text" placeholder="Enter Your Student ID (Eg: BI21110372)" id="matricNo" name="matricNo" maxlength="10" required>

        <button type="submit">Reset Password</button>
        <br><br><center><a href="index.php">Back to Homepage</a></center>
    </form>
    </div>
    <footer>
		<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
	</footer>
</body>
</html>
