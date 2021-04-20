<?php
	include '../connection.php';
	include '../functions.php';

	if (isset($_GET['id'])) {
		$plan = plan(testInput($_GET['id']));
	}
	else{
		header('Location: ../planning.php');
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		delPlan($plan['id']);
		header('Location: ../planning.php?action=delete');
	}

	include '../pagePart/header.php';
?>
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<header class="bg-info text-right pb-2 col-12">
					<h1 class="text-white text-center">deleten</h1>
				</header>
			</div>
			<div class="row">
				<form method="post" class="col-12 d-flex justify-content-center">
					<input type="submit" name="yes" class="btn btn-success mx-4" value="Ja">
					<a href="../planning.php" class="btn btn-danger mx-4">Nee</a>
				</form>
			</div>
			
		<?php
			include '../pagePart/footer.php';
		?>