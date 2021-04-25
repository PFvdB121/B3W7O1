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
	if ($dis>=10 && $dif == true) {
		header('Location: ../game.php?id=' . $game['id'] . '&dif=false');
	}

	$title = 'planning veranderen';
	
	$empty = [];

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$loop2 = false;
		$loop3 = false;
		$playTime = true;
		$amountPlayers = false;
		$x=0;
		foreach ($_POST as $key => $value) {
			if (!empty($value)) {
				$x++;
			}
			else{
				$empty[$key]="je moet deze invullen";
			}
		}

		$plan['players'] = $_POST['players'];

		$split = explode(", ", $_POST['players']);
		$amount = count($split);
		if ($amount>=$game['min_players'] && $amount<=$game['max_players']) {
			$amountPlayers = true;
		}
		else{
			if ($amount<=$game['min_players']) {
				$empty["players"] = 'Je moet minimaal ' . $game['min_players'] . ' spelers toevoegen';
			}
			elseif ($amount>=$game['max_players']) {
				$empty["players"] = 'Je moet maximaal ' . $game['max_players'] . ' spelers toevoegen';
			}
		}

		$plus = $game['explain_minutes'] + $game['play_minutes'];
		$endP = date('H:i:s', strtotime('+' . $plus . ' minutes',strtotime($_POST['clock'])));
		foreach ($planning as $p) {
			if ($game['id'] == $p['game'] && $_POST['day'] == $p['day']) {
				$endG = date('H:i:s', strtotime('+' . $plus . ' minutes',strtotime($p['clock'])));
				if (($_POST['clock']>=$p['clock'] && $_POST['clock']<=$endG) || ($endP >= $p['clock'] && $endP <=$endG)) {
					$playTime = false;
					$empty['clock'] = 'kies een andere tijd. Dit spel is al bezet';
					break;
				}
				else{
					$empty['clock'] = '';
				}
			}
		}

		$splitPOST = explode(", ", $_POST['players']);
		foreach ($planning as $p) {
			$endG = date('H:i:s', strtotime('+' . $plus . ' minutes',strtotime($p['clock'])));
			$splitPlan = explode(", ", $p['players']);
			foreach ($splitPOST as $sPOST) {
				foreach ($splitPlan as $sPlan) {
					if ($_POST['day'] == $p['day'] && $sPOST == $sPlan) {
						if (($_POST['clock']>=$p['clock'] && $_POST['clock']<=$endG) || ($endP >= $p['clock'] && $endP <=$endG)) {
							$playTime = false;
							$empty['players'] = $sPOST . ' is al op dezelfde tijd ingepland voor een ander spel';
							$loop2 = true;
							break;
						}
						else{
							$empty['players'] = '';
						}
					}
				}
				if ($loop2 == true) {
					$loop3 = true;
					break;
				}
			}
			if ($loop3 == true) {
				break;
			}
		}
		foreach ($planning as $p) {
			$endG = date('H:i:s', strtotime('+' . $plus . ' minutes',strtotime($p['clock'])));
			if ($_POST['day'] == $p['day'] && $_POST['explainer'] == $p['explainer']) {
				if (($_POST['clock']>=$p['clock'] && $_POST['clock']<=$endG) || ($endP >= $p['clock'] && $endP <=$endG)) {
					$playTime = false;
					$empty['explainer'] = $_POST['explainer'] . ' is al op dezelfde tijd ingepland voor een ander spel';
					break
				}
				else{
					$empty['explainer'] = '';
				}
			}
		}

		if ($x==count($_POST) && $amountPlayers == true && $playTime == true) {
			updatePlan(testInput(testInput($plan['id'])), testInput($_POST['day']), testInput($_POST['clock']), testInput($_POST['explainer']), testInput($_POST['players']));
			header('Location: ../planning.php?action=update');
		}
	}

	include '../pagePart/header.php';
?>
					<h1 class="text-white text-center">planning veranderen</h1>
					<a href="../planning.php" class="text-dark"><i class="fas fa-long-arrow-alt-left"></i> Terug</a>
				</header>
			</div>
			<div class="row">
				<form method="post" class="col-12 container">
					<div class="my-3 row">
						<label for="date" class="col-1">datum</label>
						<input type="date" name="day" class="offset-1" id="date" value="<?php echo $plan['day']; ?>">
						<span class="text-danger ml-1"><?php echo $empty["day"]; ?></span>
					</div class="my-3 row">
					<div class="my-3 row">
						<label for="time" class="col-1">tijd</label>
						<input type="time" name="clock" class="offset-1" id="time" value="<?php echo $plan['clock']; ?>">
						<span class="text-danger ml-1"><?php echo $empty["clock"]; ?></span>
					</div>
					<div class="my-3 row">
						<label for="explainer" class="col-1">uitlegger</label>
						<input type="text" name="explainer" class="w-50 offset-1" id="explainer" value="<?php echo $plan['explainer']; ?>">
						<span class="text-danger ml-1"><?php echo $empty["explainer"]; ?></span>
					</div>
					<div class="my-3 row">
						<label for="players" class="col-1">spelers</label>
						<input type="text" name="players" class="w-50 offset-1" id="players" value="<?php echo $plan['players'] ?>">
						<span class="text-danger ml-1"><?php echo $empty["players"]; ?></span>
					</div>
					<input class="my-3" type="submit" value="toevoegen">
				</form>
			</div>
			
		<?php
			include '../pagePart/footer.php';
		?>