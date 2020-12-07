<?php
	libxml_use_internal_errors(true);
	error_reporting(E_ALL);
	ini_set("display_errors", 1);


	$mysqli = new mysqli("mysql.eecs.ku.edu", "abdouldiallo", "LAB10eecs44820", "abdouldiallo");

	if($mysqli->connect_errno){
		printf("Connect failed: %s\n", $mysql->connect_errno);
		exit();
	}else {
		printf("Connection successful");
	}


	$result = $mysqli->query("SELECT * FROM Users");
	echo "<!DOCTYPE html>
		<html>
		<head>
		<title>List of Users</title>
		<link rel='stylesheet' type='text/css' href='styleDB.css'>
		</head>
		<body>";
	echo "<table><tr><th>User Name</th></tr>";

	while ($row = $result->fetch_assoc()) {
		echo "<tr><td>" .$row['user_id']. "</td></tr>";
		//echo $row['user_id'];
	 }
	echo "</table>";
	echo "</body>
		</html>";
	$result->free();

	$mysqli->close();
?>