<?php
	require_once 'connect/pdo.php';
	if(empty($_GET['name'])){
		die("Name parameter missing");
	}

	if(isset($_POST['logout'])){
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
			<h2>Tracking Autos for <?php echo $_GET['name'] ?></h2>
			<?php
				if(isset($_POST['add'])){
					if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
						echo '<p class="text-danger">Mileage and year must be numeric</p>';
					} else if(empty($_POST['make'])){
						echo '<p class="text-danger">Make is required</p>';
					} else {
						$stmt = $pdo->prepare('INSERT INTO autos(make, year, mileage) VALUES ( :mk, :yr, :mi)');
						$stmt->execute(array(
							':mk' => htmlentities( $_POST['make']),
							':yr' => htmlentities($_POST['year']),
							':mi' => htmlentities($_POST['mileage'])));
						echo '<p class="text-success">Record inserted</p>';
					}
				}
			?>
			<form method="post" class="small">
				<p>Make: <input type="text" name="make" style="width:40%"></p>
				<p>Year: <input type="text" name="year"></p>
				<p>Mileage: <input type="text" name="mileage"></p>
				<input type="submit" name="add"value="Add" class="btn btn-secondary btn-sm"> 
				<input type="submit" name="logout" value="logout" class="btn btn-secondary btn-sm">
			</form><br><br>
			<div class="row">
				<h3>Automobiles</h3>
				<?php
					$stmt = $pdo->query('SELECT make, mileage, year FROM autos');
					$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
				?>
				<table>
				<?php foreach($row as $rows){ ?>
					<tr>
						<td><?php echo $rows['make'] ?></td>
						<td><?php echo $rows['mileage'] ?></td>
						<td><?php echo $rows['year'] ?></td>
					</tr>
				<?php } ?>
				</table>
			</div>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>