<?php

function get_db() {
	$db = NULL;
	try { 

		$dbUrl = getenv("DATABASE_URL");

		if (!isset($dbUrl) || empty($dbUrl)) {
			$dbUrl = "postgres://ta_user:ta_pass@localhost:80/raceform";
		}
		
		$dbopts = parse_url($dbUrl);
		//print "<p>$dbUrl</p>\n\n";
		$dbHost = $dbopts["host"];
		$dbPort = $dbopts["port"];
		$dbUser = $dbopts["user"];
		$dbPassword = $dbopts["pass"];
		$dbName = ltrim($dbopts["path"],'/');
	
		$db = new PDO("pgsql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
	
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch (PDOException $ex) {

		echo "Error connecting to DB. Details: $ex";
		die();
	}
	return $db;
}