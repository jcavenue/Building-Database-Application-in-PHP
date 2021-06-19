<?php
	session_start();
	date_default_timezone_set('Asia/Manila');
	require_once 'validate.php';

	if(isset($_POST['cancel'])){
		header('Location: index.php');
	}

	if(isset($_POST['Login'])){
		if(empty($_POST['email']) && empty($_POST['pass'])){
			$_SESSION['error'] = 'Email and password are required';
			header("Location: login.php");
			return;
		} else if(validate($_POST['pass']) == false){
			error_log("Login fail ".$_POST['email']. hashed($_POST['pass']));
			$_SESSION['error'] = 'Incorrect password';
			header("Location: login.php");
			return;
		} else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false){
			$_SESSION['error'] = 'Email must have an at-sign (@)';
			header("Location: login.php");
			return;
		} else {
			$email = htmlentities($_POST['email']);
			$_SESSION['name'] = $email;
			header("Location: index.php");
			return;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>a203ea3c</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<div class="container-fluid mx-5 mt-4 px-5">
			<h2>Please Log in</h2>
			<?php
				if ( isset($_SESSION['error']) ) {
					echo '<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>";
					unset($_SESSION['error']);
				}
			?>
			<form action="login.php" method="post" class="form">
				<table>
					<tr>
						<td><label class="form-label small" for="email">User Name</label></td>
						<td><input type="text" name="email" id="email"></td>
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