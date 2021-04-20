<?php
	require '../connection.php';
	require '../functions.php';
	if (isset($_GET['id'])) {
		$game=getGame(testInput($_GET['id']));
		$planning = planning();
	}
	else{
		header('Location: ../index.php');
	}
	
	$dis = disPlan();

	$dif = true;

	foreach ($planning as $p) {
		if ($p['game']==$game['id']) {
			$dif = false;
			break;
		}
	}

	if ($dis>=1 && $dif == true) {
		header('Location: ../game.php?id=' . $game['id'] . '&dif=false');
	}

	$empty = [];

	$playTime = true;
	$succes=false;
	$x=0;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		foreach ($_POST as $key => $value) {
			if (!empty($value)) {
				$x++;
			}
			else{
				$empty[$key]="je moet deze invullen";
			}
		}

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
				if ($_POST['clock']>=$p['clock'] || $_POST['clock']<=$endG || $endP >= $p['clock'] || $endP <=$endG) {
					$playTime = false;
					$empty['clock'] = 'kies een andere tijd';
					break;
				}
			}
		}

		if ($x==count($_POST) && $amountPlayers == true && $playTime == true) {
			$succes=true;
		}

		if ($succes==true){
			insertPlan(testInput($game['id']), testInput($_POST['day']), testInput($_POST['clock']), testInput($_POST['explainer']), testInput($_POST['players']));
			header('Location: ../game.php?id=' . $game["id"] . '&action=insert');
		}
	}

	include '../pagePart/header.php';



?>
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<header class="bg-info text-right pb-2 col-12">
					<h1 class="text-white text-center"><?php echo $game['name']; ?> toevoegen</h1>
					<a href="../game.php?id=<?php echo $game['id'] ?>" class="text-dark"><i class="fas fa-long-arrow-alt-left"></i> Terug</a>
				</header>
			</div>
			<div class="row">
				<form method="post" class="col-12 container">
					<div class="my-3 row">
						<label for="date" class="col-1">datum</label>
						<input type="date" name="day" class="offset-1" id="date" value="<?php echo $_POST['day']; ?>">
						<span class="text-danger ml-1"><?php echo $empty["day"]; ?></span>
					</div class="my-3 row">
					<div class="my-3 row">
						<label for="time" class="col-1">tijd</label>
						<input type="time" name="clock" class="offset-1" id="time" value="<?php echo $_POST['clock']; ?>">
						<span class="text-danger ml-1"><?php echo $empty["clock"]; ?></span>
					</div>
					<div class="my-3 row">
						<label for="explainer" class="col-1">uitlegger</label>
						<input type="text" name="explainer" class="w-50 offset-1" id="explainer" value="<?php echo $_POST['explainer']; ?>">
						<span class="text-danger ml-1"><?php echo $empty["explainer"]; ?></span>
					</div>
					<div class="my-3 row">
						<label for="players" class="col-1">spelers</label>
						<input type="text" name="players" class="w-50 offset-1" id="players" value="<?php echo $_POST['players'] ?>">
						<span class="text-danger ml-1"><?php echo $empty["players"]; ?></span>
					</div>
					<input class="my-3" type="submit" value="toevoegen">
				</form>
			</div>
			<?php
				include '../pagePart/footer.php';
			?>
