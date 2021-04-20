<?php
	include 'connection.php';
	include 'functions.php';
	if (isset($_GET['id'])) {
		$game=getGame(testInput($_GET['id']));
	}
	else{
		header('Location: index.php');
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
					<a href="index.php" class="text-dark"><i class="fas fa-long-arrow-alt-left"></i> Terug</a>
				</header>
			</div>
			<?php
				if(isset($_GET['action'])){
					if ($_GET['action']=='insert') {
			?>
			<div class="alert alert-success row"><strong>Succesvol ingepland</strong></div>
			<?php
					}
				}
			?>
			<?php
				if(isset($_GET['dif'])){
					if ($_GET['dif']=='false') {
			?>
			<div class="alert alert-danger row"><strong>Je mag maximaal 10 verschillende spellen inplannen</strong></div>
			<?php
					}
				}
			?>
			<div class="row">
				<div class="col-12 col-md-8">
					<?php 
					echo $game['description'];
					?>
					<a href="planning/insert.php?id=<?php echo $game['id']; ?>" class='btn btn-primary mb-4'>Inplannen...</a>
					<?php
					if ($game['expansions'] != NULL) {
					?>
					<p>Uitbreidingen: <?php echo str_replace(';', ', ', $game['expansions']); ?></p>
					<?php
					}
					if ($game['skills'] != NULL) {
					?>
					<p>Nodige vaardigheden: <?php echo str_replace(';', ', ', $game['skills']); ?></p>
					<?php
					}
					?>
					<p>Minimale hoeveelheid spelers: <?php echo $game['min_players']; ?></p>
					<p>Maximale hoeveelheid spelers: <?php echo $game['max_players']; ?></p>
					<p>Uitleg tijd: <?php echo $game['explain_minutes']; ?></p>
					<p>Speeltijd: <?php echo $game['play_minutes']; ?></p>
					<?php
					if ($game['url'] != NULL){
					?>
					<a href="<?php echo $game['url']; ?>" class="d-block">Meer lezen...</a>
					<?php
					}
					if ($game['youtube'] != NULL) {
						echo $game['youtube'];
					}
					?>
				</div>
				<div class="col-12 col-md-4">
					<img alt="<?php echo $game['name'] ?>" src="images/<?php echo $game['image']; ?>" class="w-100">
				</div>
			</div>
			<?php
				include 'pagePart/footer.php';
			?>