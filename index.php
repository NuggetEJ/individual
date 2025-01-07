<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<title>UMS FCI My Study KPI System</title>
<style>
	body {
		margin: 0;
		font-family: "Raleway", sans-serif;
		padding-bottom: 60px;
		background: url(img/back.jpg);
	}
	header {
		background-color: #09a8bd;
		height: 90px;
		font-size: 20px;
		color: #000000;
		display: flex;
		align-items: center;
		padding: 15px;
	}
	footer {
		position: fixed;
		bottom: 0;
		width: 100%;
		height: 25px;    /* Height of the footer */
		background: #09a8bd;
		color: #000000;
		text-align: center;
		font-size: 15px;
		padding: 10px;
	}
	.row {
		display: flex;
		flex-wrap: wrap; /* Allow wrapping on smaller screens */
		justify-content: center;
	}
	h1{
		text-align: center;
		font-size: 60px;
	}
</style>
</head>
<body>
    <header>
		<img src="img/logo.png" style="width:auto;height:80%;">
		<div style="flex-grow:1; text-align:right;">
			<button onclick="window.location.href='contact_us.php'" style="width:auto;background-color: #000000;">Contact Us</button>
		</div>
	</header>

	<div class="row">
		<h1>Welcome to<br>FCI My Study KPI System<h1>
	</div>
	
	<div class="row">
		<?php include 'login.php'; ?> <br>
	</div>

	<div class="row">
		<?php include 'register.php'; ?>
		
	</div>
	
	<div class="row">
		<footer>
			<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
		</footer>
	</div>
	<script src="js/script.js"></script>
</body>
</html>