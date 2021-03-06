<?php
	require_once 'connect/pdo.php';
	session_start();
	if ( !isset($_SESSION['name']) ) {
   		die('ACCESS DENIED');
	}

	if(isset($_POST['cancel'])){
		header('Location: index.php');
	}

	if(isset($_POST['add'])){

		if(!$_POST['make'] || !$_POST['model'] || !$_POST['year'] || !$_POST['mileage']){
			$_SESSION['error'] = 'All fields are required';
			header('Location: add.php');
			return;
		} 
		
		if(!is_numeric($_POST['year'])){
			$_SESSION['error'] = 'Year must be numeric';
			header('Location: add.php');
			return;
		} 
		
		if(!is_numeric($_POST['mileage'])){
			$_SESSION['error'] = 'Mileage must be numeric';
			header('Location: add.php');
			return;
		} 
		
		$stmt = $pdo->prepare('INSERT INTO autos(make ,model, year, mileage) VALUES ( :mk, :md, :yr, :mi)');
		$stmt->execute([
			':mk' => $_POST['make'],
			':md' => $_POST['model'],
			':yr' => $_POST['year'],
			':mi' => $_POST['mileage']]);
		$_SESSION['success'] = "Record added.";
		header("Location: index.php");
		return;
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>e5688b71</title>
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
				<p>Year: <input type="text" name="model"></p>
				<p>Year: <input type="text" name="year"></p>
				<p>Mileage: <input type="text" name="mileage"></p>
				<button type="submit" name="add" value="Add"class="btn btn-secondary btn-sm">Add</button>
				<button type="submit" name="cancel" class="btn btn-secondary btn-sm">cancel</button>
			</form>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>