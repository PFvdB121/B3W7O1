<?php
	include 'connection.php';
	include 'functions.php';

	$planning = planning();

	$title = 'planning';

	include 'pagePart/header.php';
?>
					<h1 class="text-white text-center">planning</h1>
				</header>
			</div>
			<nav class="nav nav-tabs">
				<a href="index.php" class="nav-link">kiezen</a>
				<a href="planning.php" class="nav-link active">plannen</a>
				<a href="days.php" class="nav-link">Ingepande speeldagen</a>
			</nav>
			<?php
				if(isset($_GET['action'])){
					if ($_GET['action']=='delete') {
			?>
			<div class="alert alert-success row"><strong>Succesvol gedelete</strong></div>
			<?php
					}
					elseif ($_GET['action']=='update') {
			?>
			<div class="alert alert-success row"><strong>Succesvol veranderd</strong></div>
			<?php
					}
				}
			?>
			<div class="row border-bottom border-secondary">
				<span class="col-2"><strong>spel</strong></span>
				<span class="col-2"><strong>wanneer?</strong></span>
				<span class="col-2"><strong>speeltijd</strong></span>
				<span class="col-2"><strong>uitlegger</strong></span>
			</div>
			<?php
				foreach ($planning as $p) {
					$game = getGame($p['game']);
					$plus = $game['play_minutes'] + $game['explain_minutes'];
					$end = date('H:i:s', strtotime('+' . $plus . ' minutes',strtotime($p['clock'])));
			?>
			<div class="row border-bottom border-secondary">
				<span class="col-2"><a href="plan.php?id=<?php echo $p['id']; ?>"><?php echo $game['name']; ?></a></span>
				<span class="col-2"><?php echo $p['day']; ?> <?php echo $p['clock']; ?></span>
				<span class="col-2"><?php echo $game['explain_minutes']?> minuten uitleggen<br><?php echo $game['play_minutes']?> minuten spelen<br>Tot <?php echo $end; ?></span>
				<span class="col-2"><?php echo $p['explainer'] ?></span>
				<span class="col-2"><a href="planning/update.php?id=<?php echo $p['id']; ?>" class="text-dark"><i class="fas fa-pencil-alt text-warning"></i>Veranderen</a></span>
				<span class="col-2"><a href="planning/delete.php?id=<?php echo $p['id']; ?>" class="text-dark"><i class="fas fa-ban text-danger"></i>Verwijderen</a></span>
			</div>
			<?php
				}
			?>
		<?php
			include 'pagePart/footer.php';
		?>