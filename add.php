<?php
	require_once 'connect/pdo.php';
	session_start();
	if ( !isset($_SESSION['name']) ) {
   		die('Not logged in');
	}

	if(isset($_POST['cancel'])){
		header('Location: view.php');
	}

	if(isset($_POST['add'])){
		if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
			$_SESSION['error'] = 'Mileage and year must be numeric';
			header('Location: add.php');
			return;
		} else if(empty($_POST['make'])){
			$_SESSION['error'] = 'Make is required';
			header('Location: add.php');
			return;
		} else {
			$stmt = $pdo->prepare('INSERT INTO autos(make, year, mileage) VALUES ( :mk, :yr, :mi)');
			$stmt->execute(array(
				':mk' => htmlentities( $_POST['make']),
				':yr' => htmlentities($_POST['year']),
				':mi' => htmlentities($_POST['mileage'])));
				$_SESSION['success'] = "Record inserted";
			header("Location: view.php");
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
			<h2>Tracking Autos for <?php echo $_SESSION['name'] ?></h2>
			<?php
				if(isset($_SESSION['error'])){
					echo '<p class="text-danger">' . $_SESSION['error'] . "</p>";
					unset($_SESSION['error']);
				}
			?>
			<form method="post" class="small">
				<p>Make: <input type="text" name="make" style="width:40%"></p>
				<p>Year: <input type="text" name="year"></p>
				<p>Mileage: <input type="text" name="mileage"></p>
				<button type="submit" name="add" value="Add"class="btn btn-secondary btn-sm">Add</button>
				<button type="submit" name="cancel" class="btn btn-secondary btn-sm">cancel</button>
			</form>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>