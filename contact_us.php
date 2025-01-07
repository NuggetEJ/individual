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
    nav{
        text-align: center;
		font-size: 20px;
    }
</style>
</head>
<body>
    <header>
		<img src="img/logo.png" style="width:auto;height:80%;">
        <div style="flex-grow:1; text-align:right;">
			<a href="index.php"><img src="icons/home.png" alt="Home" style="width:70px;height:70px;"></a>
		</div>
	</header>

	<h1>Contact Us</h1>
    <p>Jalan UMS, 88400 Kota Kinabalu, Sabah , Malaysia</p>
    <p>Tel : (+6088) 320000 / 320474<br><br>
	<a href="https://www.ums.edu.my/v5/" target="_blank" style="align:center;">UMS Official Website - HOME</a></p><br>
	
	<h2>Follow Us @:</h2>
    <nav>
        <a href="https://www.facebook.com/UMS.official" target="_blank"><img src="icons/facebook.png" alt="Facebook" style="width:50px;height:50px;"></a>&nbsp;&nbsp;&nbsp;
        <a href="https://www.linkedin.com/school/umsofficial/" target="_blank"><img src="icons/linkedin.png" alt="LinkedIn" style="width:50px;height:50px;"></a>&nbsp;&nbsp;&nbsp;
        <a href="https://twitter.com/UMS_EcoCampus?s=09" target="_blank"><img src="icons/twitter.jpg" alt="Twitter" style="width:50px;height:50px;"></a>&nbsp;&nbsp;&nbsp;
        <a href="https://api.whatsapp.com/send?phone=6088320000" target="_blank"><img src="icons/whatsapp.png" alt="WhatsApp" style="width:50px;height:50px;"></a>&nbsp;&nbsp;&nbsp;
        <a href="https://www.instagram.com/umsofficial/" target="_blank"><img src="icons/insta.png" alt="Instagram" style="width:50px;height:50px;"></a>&nbsp;&nbsp;&nbsp;
        <a href="https://www.youtube.com/channel/UCkriQ1ronfQofaoVH1qYk8A" target="_blank"><img src="icons/youtube.png" alt="Youtube" style="width:50px;height:50px;"></a>&nbsp;&nbsp;&nbsp;
        <a href="https://www.flickr.com/people/124730570@N03/" target="_blank"><img src="icons/flickr.png" alt="Flickr" style="width:50px;height:50px;"></a>&nbsp;&nbsp;&nbsp;
    </nav>

	<div class="row">
		<footer>
			<small><i>Copyright &copy; 2023 - Elizabeth Anak Jimmy</i></small>
		</footer>
	</div>
</body>
</html>