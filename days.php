<?php 
	include 'connection.php';
	include 'functions.php';

	$day = day();

	$title = 'geplande speldagen';

	include 'pagePart/header.php';
?>					
					<h1 class="m-0 text-white text-center">geplande speldagen</h1>
				</header>
			</div>
			<nav class="nav nav-tabs">
				<a href="index.php" class="nav-link">kiezen</a>
				<a href="planning.php" class="nav-link">plannen</a>
				<a href="days.php" class="nav-link active">Ingepande speeldagen</a>
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
			<div class="row border">
				<div class="col-2 border-right border-secondary">
					<strong>Datum</strong>
				</div>
				<div class="col-2 border-right border-secondary">
					<strong>Spellen</strong>
				</div>
				<div class="col-2 border-right border-secondary">
					<strong>Begintijd</strong>
				</div>
				<div class="col-2 border-right border-secondary">
					<strong>Eindtijd</strong>
				</div>
			</div>
			<?php
				foreach ($day as $D) {
					$split = explode(', ', $D['games']);
			?>
			<div class="row border border-secondary">
				<div class="col-2 border-right border-secondary">
					<?php echo $D['day']; ?>
				</div>
				<div class="col-2 border-right border-secondary">
					<ul class="list-unstyled">
						<?php 
							foreach ($split as $S) {
						?>
						<li><?php echo $S; ?></li>
						<?php
							}
						?>
					</ul>
				</div>
				<div class="col-2 border-right border-secondary">
					<?php echo $D['start']; ?>
				</div>
				<div class="col-2 border-right border-secondary">
					<?php echo $D['finish']; ?>
				</div>
				<div class="col-2 border-right border-secondary">
					<a href="planning/updatePlan.php?id=<?php echo $D['id']; ?>" class="text-dark"><i class="fas fa-pencil-alt text-warning"></i>Veranderen</a>
				</div>
				<div class="col-2">
					<a href="planning/deletePlan.php?id=<?php echo $D['id']; ?>" class="text-dark"><i class="fas fa-ban text-danger"></i>Verwijderen</a>
				</div>
			</div>
			<?php
				}
			?>
<?php
	include 'pagePart/footer.php'
?>