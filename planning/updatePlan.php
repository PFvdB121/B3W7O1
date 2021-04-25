<?php
	include '../connection.php';
	include '../functions.php';

	if (isset($_GET['id'])) {
		$plannedDay = getDay(testInput($_GET['id']));
		$day = $plannedDay['day'];
		$start = $plannedDay['start'];
		$finish = $plannedDay['finish'];
	}
	else{
		header('Location: ../days.php');
	}

	$title = 'dagen inplannen';
	if (isset($_GET['dat'])) {
		$day = $_GET['day'];
	}
	if (isset($_GET['start'])){
		$start = $_GET['start'];
	}
	if (isset($_GET['finish'])){
		$finish = $_GET['finish'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {		
		$day = $_POST['day'];
		$start = $_POST['start'];
		$finish = $_POST['finish'];
		$x=0;
		foreach ($_POST as $key => $P) {
			if (!empty($P)) {
				$x++;
			}
			else{
				$empty[$key] = 'Je moet deze invullen';
			}
		}
		if ($x == count($_POST)) {
			header('Location: updatePlanG.php?id=' . testInput($_GET['id']) . '&day=' . $_POST['day'] . '&start=' . $_POST['start'] . '&finish=' . $_POST['finish']);
		}
	}

	include '../pagePart/header.php';

?>

					<h1 class="text-white text-center">dagen inplannen</h1>
					<a href="../days.php" class="text-dark"><i class="fas fa-long-arrow-alt-left"></i> Terug</a>
				</header>
			</div>
			<div class="row">
				<form method="post" class="col-12">
					<ul class="list-unstyled">
						<li><h3>speldag insplannen</h3></li>
						<li class="mt-1">
							<label for="day" class="col-1">dag</label>
							<input type="date" name="day" id="day" value="<?php echo $day; ?>">
							<span class="text-danger"><?php echo $empty['day']; ?></span>
						</li>
						<li class="mt-1">
							<label for="start" class="col-1">begintijd</label>
							<input type="time" name="start" id="start" value="<?php echo $start; ?>">
							<span class="text-danger"><?php echo $empty['start']; ?></span>
						</li>
						<li class="mt-1">
							<label for="finish" class="col-1">eindtijd</label>
							<input type="time" name="finish" id="finish" value="<?php echo $finish; ?>">
							<span class="text-danger"><?php echo $empty['finish']; ?></span>
						</li>
						<li><input type="submit" value="submit"></li>
					</ul>
				</form>
			</div>

<?php
	include '../pagePart/footer.php';
?>