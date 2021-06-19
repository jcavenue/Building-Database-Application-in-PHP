<?php
	session_start();
	require_once 'connect/pdo.php';

	if (!isset($_SESSION['name']) ) {
   		die('Not logged in');
	}
 
	
?>
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
			<div class="row small">
				<h2>Tracking Autos for <?php echo $_SESSION['name'] ?></h2>
				<?php
					if ( isset($_SESSION['success']) ) {
						echo '<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>";
						unset($_SESSION['success']);
					}
				?>
				<h3>Automobiles</h3>
				<?php
					$stmt = $pdo->query('SELECT make, mileage, year FROM autos');
					$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
				?>
				<?php foreach($row as $rows){ ?>
					<ul>
						<li>
							<?php echo $rows['year']. " " . $rows['make'] . " / ". $rows['mileage']; ?>
						</li>
					</ul>
				<?php } ?>
			</div>
			<div class="row small">
				<p><a href="add.php">Add New</a> | <a href="logout.php">Logout</a></p>
			</div>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>