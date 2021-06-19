<?php 
	session_start();
	require_once 'connect/pdo.php';
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
			<h2>Welcome to the Automobiles Database</h2>
			<?php 
			if(isset($_SESSION['error'])){
				echo '<p class="text-danger">' . htmlentities($_SESSION['error']) . "</p>";
				unset($_SESSION['success']);
			}

			if(isset($_SESSION['success'])){
				echo '<p class="text-success">' . htmlentities($_SESSION['success']) . "</p>";
				unset($_SESSION['success']);
			}
			
			if(!isset($_SESSION['name'])){ ?>
				<p class="small"><a href="login.php">Please log in</a></p>
				<p class="small">Attempt to <a href="add.php">add data</a> without logging in</p>
			<?php } else { 
				$stmt = $pdo->query('SELECT * FROM autos');
				$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if($row == false){
					echo '<p class="small">No rows found</p>';
				} else { ?>
				<table>
					<thead>
						<tr>
							<th>Make</th>
							<th>Model</th>
							<th>Year</th>
							<th>Mileage</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($row as $rows){ ?>
						<tr>
							<td><?php echo $rows['make']; ?></td>
							<td><?php echo $rows['model']; ?></td>
							<td><?php echo $rows['year']; ?></td>
							<td><?php echo $rows['mileage']; ?></td>
							<td><a href="edit.php?autos_id=<?php echo $rows['autos_id']; ?>">Edit</a> / 
								<a href="delete.php?autos_id=<?php echo $rows['autos_id']; ?>">Delete</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			<?php } ?>
				<p class="small"><a href="add.php">Add New Entry</a></p>
				<p class="small"><a href="logout.php">Logout</a></p>
			
			<?php } ?>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>