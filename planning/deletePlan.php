<?php
	include '../connection.php';
	include '../functions.php';

	if (isset($_GET['id'])) {
		$day = getDay(testInput($_GET['id']));
	}
	else{
		header('Location: ../days.php');
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		delDay($day['id']);
		header('Location: ../days.php?action=delete');
	}

	$title = 'deleten speeldag';

	include '../pagePart/header.php';
?>
					<h1 class="text-white text-center">deleten</h1>
				</header>
			</div>
			<div class="row">
				<strong class="text-center w-100">Weet u zeker dat u de speldag op <?php echo $day['name']; ?> wilt verwijderen?</strong>
				<form method="post" class="col-12 d-flex justify-content-center">
					<input type="submit" name="yes" class="btn btn-success mx-4" value="Ja">
					<a href="../days.php" class="btn btn-danger mx-4">Nee</a>
				</form>
			</div>
			
		<?php
			include '../pagePart/footer.php';
		?>