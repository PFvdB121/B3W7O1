<?php
	include '../connection.php';
	include '../functions.php';

	if (isset($_GET['id'])) {
		$plan = plan(testInput($_GET['id']));
		$game = getGame($plan['game']);
	}
	else{
		header('Location: ../planning.php');
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		delPlan($plan['id']);
		header('Location: ../planning.php?action=delete');
	}

	$title = 'deleten';

	include '../pagePart/header.php';
?>
					<h1 class="text-white text-center">deleten</h1>
				</header>
			</div>
			<div class="row">
				<strong class="text-center w-100">Weet u zeker dat u de afspraak om <?php echo $game['name']; ?> te spelen op <?php echo $plan['day']; ?> om <?php echo $plan['clock']; ?> wilt verwijderen?</strong>
				<form method="post" class="col-12 d-flex justify-content-center">
					<input type="submit" name="yes" class="btn btn-success mx-4" value="Ja">
					<a href="../planning.php" class="btn btn-danger mx-4">Nee</a>
				</form>
			</div>
			
		<?php
			include '../pagePart/footer.php';
		?>