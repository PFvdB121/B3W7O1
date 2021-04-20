<?php
	include 'connection.php';
	include 'functions.php';

	if (isset($_GET['id'])) {
		$plan = plan(testInput($_GET['id']));
		$game = getGame($plan['game']);
	}
	else{
		header('Location: ../index.php');
	}

	include 'pagePart/header.php';
?>
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<header class="bg-info text-right pb-2 col-12">
					<h1 class="text-white text-center"><?php echo $game['name']; ?></h1>
					<a href="planning.php" class="text-dark"><i class="fas fa-long-arrow-alt-left"></i> Terug</a>
				</header>
			</div>
			<div class="row">
				<div class="col-12">
					<p class="d-block">Datum: <?php echo $plan['day']; ?></p>
					<p class="d-block">Tijd: <?php echo $plan['clock']; ?></p>
					<p class="d-block">Uitlegger: <?php echo $plan['explainer']; ?></p>
					<textarea class="d-block">Spelers: <?php echo $plan['players'] ?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-8">
					<?php echo $game['description']; ?>
					<?php
						if ($game['expansions'] != NULL) {
					?>
					<p>Uitbreidingen: <?php echo str_replace(';', ', ', $game['expansions']); ?></p>
					<?php
						}
						if ($game['skills'] != NULL) {
					?>
					<p>Nodige Vaardigheden: <?php echo  str_replace(';', ', ', $game['skills']); ?></p>
					<?php
						}
					?>
					<p>Minimale hoeveelheid spelers: <?php echo $game['min_players']; ?></p>
					<p>Maximale hoeveelheid spelers: <?php echo $game['max_players']; ?></p>
					<p>Uitleg tijd: <?php echo $game['explain_minutes']; ?></p>
					<p>Speeltijd: <?php echo $game['play_minutes']; ?></p>
					<?php
						if($game['url'] != NULL){
					?>
					<a href="<?php echo['url']; ?>" class='d-block'>Meer lezen...</a>
					<?php
						}
						if ($game['youtube'] != NULL) {
							echo $game['youtube'];
						}
					?>
				</div>
				<div class="col-4">
					<img alt="<?php echo $game['name']; ?>" src="images/<?php echo $game['image']; ?>" class='w-100'>
				</div>
			</div>
		<?php
			include 'pagePart/footer.php';
		?>