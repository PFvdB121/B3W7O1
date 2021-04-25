<?php
	include 'connection.php';
	include 'functions.php';
	$games = getGames();

	$title = 'Spellen plannen';

	include 'pagePart/header.php';
?>
					<h1 class="m-0 text-white text-center">Spellen plannen</h1>
				</header>
			</div>
			<nav class="nav nav-tabs">
				<a href="index.php" class="nav-link active">kiezen</a>
				<a href="planning.php" class="nav-link">plannen</a>
				<a href="days.php" class="nav-link">Ingepande speeldagen</a>
			</nav>
			<div class="row border border-secondary">
				<a href="planning/planDay.php" class="ml-4"><i class="fas fa-clock text-dark"></i>Dagen inplannen</a>
			</div>
			<div class="row">
			<?php
				foreach ($games as $g) {
			?>
				<div class="border-bottom border-secondary col-12 col-md-6">
					<div class="container">
						<div class="row">
							<div class="col-6 position-relative">
								<h2 class="text-center"><?php echo $g['name']; ?></h2>
								<?php echo $g['description']; ?>
								<a href="game.php?id=<?php echo $g['id'] ?>" class="btn btn-info">Lees meer...</a>
							</div>
							<div class="col-6">
								<img alt="<?php echo $g['name'] ?>" src="images/<?php echo $g['image'] ?>" class="w-100">
							</div>
						</div>
					</div>
				</div>
			<?php
				}
			?>
			</div>
			<?php
				include 'pagePart/footer.php';
			?>