<?php
	function getGames(){
		$conn = createConnection();
		$sql = 'SELECT * FROM games ORDER BY name';
		$sth = $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	function getGame($id){
		$conn = createConnection();
		$sql = 'SELECT * FROM games WHERE id=:id';
		$sth = $conn->prepare($sql);
		$sth->bindParam(':id', $id);
		$sth->execute();
		$result = $sth->fetch();
		return $result;
	}

	function insertPlan($game, $day, $clock, $explainer, $players){
		$conn = createConnection();
		$sql = 'INSERT INTO planning (game, day, clock, explainer, players) VALUES (:game, :day, :clock, :explainer, :players)';
		$sth = $conn->prepare($sql);
		$sth->bindParam(':game', $game);
		$sth->bindParam(':day', $day);
		$sth->bindParam(':clock', $clock);
		$sth->bindParam(':explainer', $explainer);
		$sth->bindParam(':players', $players);
		$sth->execute();
	}

	function planning(){
		$conn = createConnection();
		$sql = 'SELECT * FROM planning ORDER BY day, clock';
		$sth = $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	function plan($id){
		$conn = createConnection();
		$sql = 'SELECT * FROM planning WHERE id=:id';
		$sth = $conn->prepare($sql);
		$sth->bindParam(':id', $id);
		$sth->execute();
		$result = $sth->fetch();
		return $result;
	}

	function delPlan($id){
		$conn = createConnection();
		$sql = 'DELETE FROM planning WHERE id=:id';
		$sth = $conn->prepare($sql);
		$sth->bindParam(':id', $id);
		$sth->execute();
	}

	function updatePlan($id, $day, $clock, $explainer, $players){
		$conn = createConnection();
		$sql = 'UPDATE planning SET day = :day, clock = :clock, explainer = :explainer, players = :players WHERE id = :id';
		$sth = $conn->prepare($sql);
		$sth->bindParam(':id', $id);
		$sth->bindParam(':day', $day);
		$sth->bindParam(':clock', $clock);
		$sth->bindParam(':explainer', $explainer);
		$sth->bindParam(':players', $players);
		$sth->execute();
	}

	function disPlan(){
		$conn = createConnection();
		$sql = 'SELECT COUNT(DISTINCT game) FROM planning';
		$sth = $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetch();
		return $result;
	}

	function testInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>