<?php
	session_start();
	require_once 'connect/pdo.php';

	if ( ! isset($_SESSION['name']) ) {
   		die('Not logged in');
	}



?>
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
			<div class="row">
				<h2>Tracking Autos for <?php echo $_SESSION['name'] ?></h2>
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
			<a href="add.php">Add</a> | <a href="logout.php">logout</a>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>