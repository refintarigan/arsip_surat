<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN KICKY MAULANA</title>
	<style type="text/css">
		body{
			font-size: 11pt;
			font-family: times new roman;
			background: white;
			text-transform: uppercase;
		}
		.form-container{
			width: 400px;
			margin: 30px auto;
			padding: -10px;
		}
		form{
			width: 50%;
			box-shadow: 0px 1px 10px -2px;
		}
		input[type=text], input[type=password]{
			width: 50%;
			margin: 10px 0px;
			padding: 10px 20px;
			box-sizing: border-box;
		}
		.link {
			color: white;
			text-decoration: none;
			font-size: 10pt;
		}
		button{
			background: #2aa7e2;
			color: white;
			font-size: 11pt;
			width: 50%;
			border: none;
			border-radius: 3px;
			padding: 10px 20px;
			cursor: pointer;
		}
		.img-container{
            background-color: black;
            color: white;
			text-align: center;
			margin: 0px 0px;
			padding: 20px 0px;
		}
		img.avatar{
			width: 40%;
			border-radius: 50%;	
		}
		.container{
			margin-top: -50px;
			padding: 30px;
            background-color: black;
            color:;
		}
	</style>
</head>
<body>
	
	<div class="form-container"></div>
	<center>
	<form action="proses.php" method="POST">
		<div class="img-container">
			<img src="" alt="" class="avatar">
			<img src="logoo.PNG" width="60%">
			<h2>ARCHIVIO</h2><br>
		<h2><u>Silahkan Login</u></h2></div>
	<div class="container">
	<input type="text" name="username" placeholder="Username" required autocomplete="off" autofocus>
	<input type="password" name="password" placeholder="Password" required autocomplete="off" autofocus>
	<button type="submit" name="login">Login </button><br>
	<center><a class="link" href="icon.php">Back</center></div>
	</form></center>
</body>
</html>
