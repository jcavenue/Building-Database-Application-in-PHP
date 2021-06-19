<?php
	require_once 'connect/pdo.php';




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