<?php
try {
	// $db_host = "";
	// $db_name = "";
	// $db_username = "";
	// $db_password = "";
	$db = new PDO("sqlite:$path/database.db");
	// $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "Siuuuu";
} catch (Exception $e) {
	echo $e->getMessage();
}

?>