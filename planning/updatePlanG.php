<?php
	include '../connection.php';
	include '../functions.php';

	$games = getGames();

	$title = 'spellen inplannen voor dag';
	$x = 1;

	$gamePlan = "";

	if (isset($_GET['id']) && isset($_GET['day']) && isset($_GET['start']) && isset($_GET['finish'])) {
		$id = testInput($_GET['id']);
		$day = testInput($_GET['day']);
		$start = testInput($_GET['start']);
		$finish = testInput($_GET['finish']);
	}
	else{
		header('Location: ../days.php');
	}

	$plannedDay = getDay(testInput($_GET['id']));
	$split = explode(', ', $plannedDay['games']);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$GP = 0;
		foreach ($_POST as $key => $P) {
			if (isset($P)) {
				$GP++;
				$gamePlan .= $P;
				if ($GP < count($_POST)) {
					$gamePlan .= ", ";
				}
			}
		}
		updateDay($id, $day, $start, $finish, testInput($gamePlan));
		header('Location: ../days.php?action=update');
	}

	include '../pagePart/header.php';

?>

					<h1 class="text-white text-center">dagen inplannen</h1>
					<a href="updatePlan.php?id=<?php echo $id; ?>&day=<?php echo $day; ?>&start=<?php echo $start ?>&finish=<?php echo $finish ?>" class="text-dark"><i class="fas fa-long-arrow-alt-left"></i> Terug</a>
				</header>
			</div>
			<div class="row">
				<form method="post" class="col-12">
					<ul class="list-unstyled">
						<li class="mt-4"><h3>Spellen kiezen</h3></li>
						<?php
							foreach ($games as $g) {
						?>
						<li>
							<input type="checkbox" name="game<?php echo $x ?>" value="<?php echo $g['name']; ?>" id="game<?php echo $x ?>"
								<?php
									foreach ($split as $s) {
										if ($g['name'] == $s) {
								?>
								checked
								<?php
											break;
										}
									}
								?>
								>
							<label for="game<?php echo $x ?>"><?php echo $g['name'] ?></label>
						</li>
						<?php
							$x++;
							}
						?>
						<li><input type="submit" value="submit"></li>
					</ul>
				</form>
			</div>

<?php
	include '../pagePart/footer.php';
?>