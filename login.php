<?php
	require_once "connect/pdo.php";

	if(isset($_POST['Login']) && isset($_POST['email']) && isset($_POST['pass'])){
	

	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<div class="container m-3 p-3">
			<h2>Please Log in</h2>
			<form method="POST" class="form">
				<table>
					<tr>
						<td><label class="form-label small" for="email">Email</label></td>
						<td><input type="text" name="email" id="email"></td>
					</tr>
					<tr>
						<td><label class="form-label small"for="pass">Password</label></td>
						<td><input type="pass" name="pass" id="pass"></td>
					</tr>
				</table><br>
				<input type="submit" name="Login= "value="Log In" class="btn btn-primary btn-sm">
				<input type="submit" name="cancel" value="cancel" class="btn btn-secondary btn-sm">
			</form>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>