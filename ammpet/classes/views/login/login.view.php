<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<link rel="stylesheet" href="../public/assets/css/styles.css">
	
	<div id="box">
		
		<form method="post" action="../classes/controllers/CredentialCheck.php">
			<input type="hidden" name="type" value="login">
			
			<div style="font-size: 20px;margin: 10px;color: white;">Login:</div>

			<input id="login" type="text" name="login"><br><br>

			<div style="font-size: 20px;margin: 10px;color: white;">Password:</div>
			<input id="pass" type="password" name="pass"><br><br>

			<input id="button" type="submit" value="Submit"><br><br>

		</form>
	</div>
</body>
</html>