<?php
	require_once "connect/pdo.php";
	session_start();

	if ( isset($_POST['delete']) && isset($_POST['autos_id']) ) {
		$sql = "DELETE FROM autos WHERE autos_id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':id' => $_POST['autos_id']));
		$_SESSION['success'] = 'Record deleted';
		header( 'Location: index.php' ) ;
		return;
	}

	if (!isset($_GET['autos_id']) ) {
		$_SESSION['error'] = "Missing Autos_id";
		header('Location: index.php');
		return;
	}

	$stmt = $pdo->prepare("SELECT make, autos_id FROM autos where autos_id = :id");
	$stmt->execute(array(":id" => $_GET['autos_id']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ( $row === false ) {
		$_SESSION['error'] = 'Bad value for user_id';
		header( 'Location: index.php' ) ;
		return;
	}



?>

<p>Confirm: Deleting <?php echo htmlentities($row['make']); ?></p>
<form method="post">
<input type="hidden" name="autos_id" value="<?= $row['autos_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="index.php">Cancel</a>
</form>