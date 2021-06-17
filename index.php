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
			<h1>Please Log in</h1>
			<form method="POST" class="form">
				<label class="form-label" for="email"><strong>Email : </strong></label></td>
				<input type="text" name="email" id="email"><br>
				<label for="pass"><strong>Password : </strong> </label>
				<input type="pass" name="pass" id="pass"><br><br>
				<input type="submit" value="Log In" class="btn btn-primary btn-sm">
				<input type="submit" name="cancel" value="cancel" class="btn btn-secondary btn-sm">
			</form>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>