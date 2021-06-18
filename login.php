<?php
	date_default_timezone_set('Asia/Manila');
	require_once 'validate.php';

	if(isset($_POST['cancel'])){
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>5abb1c90</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<div class="container-fluid mx-5 mt-4 px-5">
			<h2>Please Log in</h2>
			<?php
				if(isset($_POST['Login'])){
					if(empty($_POST['who']) && empty($_POST['pass'])){
						echo '<p class="text-danger small">Email and password are required</p>';
					} else if(validate($_POST['pass']) == false){
						error_log("Login fail ".$_POST['who']. hashed($_POST['pass']));
						echo '<p class="text-danger small">Incorrect password</p>';
					} else if (filter_var($_POST['who'], FILTER_VALIDATE_EMAIL) == false){
						echo '<p class="text-danger small">Email must have an at-sign (@)</p>';
					} else {
						$who = htmlentities($_POST['who']);
						error_log("Login success ".$_POST['who']);
						header("Location: autos.php?name=".urlencode($who));
					}
				}

			?>
			<form method="post" class="form">
				<table>
					<tr>
						<td><label class="form-label small" for="email">User Name</label></td>
						<td><input type="text" name="who" id="email"></td>
					</tr>
					<tr>
						<td><label class="form-label small"for="pass">Password</label></td>
						<td><input type="pass" name="pass" id="pass"></td>
					</tr>
				</table><br>
				<input type="submit" name="Login" value="Log In" class="btn btn-primary btn-sm">
				<input type="submit" name="cancel" value="Cancel" class="btn btn-secondary btn-sm">
			</form>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>