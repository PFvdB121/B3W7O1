<?php
	function createConnection(){
		try{
			$conn = new PDO('mysql:host=localhost;dbname=databank_php', 'root', 'mysql');
			return $conn;
		} catch (PDOException $e) {
			print("Error!: " . $e->getMessage() . "<br>");
			die();
		}
	}
?>