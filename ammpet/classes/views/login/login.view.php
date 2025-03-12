<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<link rel="stylesheet" href="../public/assets/css/styles.css">
	
	<div id="box">
		
		<form method="post" action="../public/Auth">

			<input type="hidden" name="op" value="signin">			
			
			<div style="font-size: 20px;font-family: sans-serif;margin: 5px;color: white;">Login:</div>
			<input id="login" type="text" name="login" size="20" value="KBACON"><br><br>

			<div style="font-size: 20px;font-family: sans-serif;margin: 5px;color: white;">Password:</div>
			<input id="pass" type="password" name="pass" size="20" value="K1234"><br><br><br>

			<input id="button" type="submit" value="Submit"><br><br><br><br>

		</form>
	</div>
</body>
</html>