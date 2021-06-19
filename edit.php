<?php
	require_once "connect/pdo.php";
	session_start();

	if(isset($_POST['cancel'])){
		header('Location: index.php');
	}

	if ( isset($_POST['save'])) {
		
		if(!$_POST['make'] || !$_POST['model'] || !$_POST['year'] || !$_POST['mileage']){
			$_SESSION['error'] = 'All fields are required';
			header('Location: edit.php?autos_id=' . $_POST['autos_id'] );
			return;
		} 
		
		if(!is_numeric($_POST['year'])){
			$_SESSION['error'] = 'Year must be numeric';
			header('Location: edit.php?autos_id=' . $_POST['autos_id']);
			return;
		} 
		
		if(!is_numeric($_POST['mileage'])){
			$_SESSION['error'] = 'Mileage must be numeric';
			header('Location: edit.php?autos_id=' . $_POST['autos_id']);
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

	if ( ! isset($_GET['autos_id']) ) {
	$_SESSION['error'] = "Missing autos_id";
	header('Location: index.php');
	return;
	}

	$stmt = $pdo->prepare("SELECT * FROM autos where autos_id = :id");
	$stmt->execute(array(":id" => $_GET['autos_id']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ( $row === false ) {
		$_SESSION['error'] = 'Bad value for autos_id';
		header( 'Location: index.php' ) ;
		return;
	}

	$mk = htmlentities($row['make']);
	$md = htmlentities($row['model']);
	$yr = htmlentities($row['year']);
	$ma = htmlentities($row['mileage']);
	$autos_id = $row['autos_id'];

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
			<h2>Editing Automobile</h2>
			<?php
				if(isset($_SESSION['error'])){
					echo '<p class="text-danger">' . $_SESSION['error'] . "</p>";
					unset($_SESSION['error']);
				}
			?>
			<form method="post" class="small">
				<p>Make:
				<input type="text" name="make" value="<?= $mk ?>"></p>
				<p>Model:
				<input type="text" name="model" value="<?= $md ?>"></p>
				<p>Year:
				<input type="text" name="year" value="<?= $yr ?>"></p>
				<p>Mileage:
				<input type="text" name="mileage" value="<?= $ma ?>"></p>
				<input type="hidden" name="autos_id" value="<?= $autos_id ?>">
				<input type="submit" name="save" value="Save"/> <input type="submit" name="cancel" value="cancel"/>
			</form>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

