<?php
	$user = $_POST['user-ids'];

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

	function viewPosts($user, $mysqli){
		$sql = "SELECT * FROM Posts WHERE author_id =?";
		$checkQuery = $mysqli->prepare($sql);
		$checkQuery->bind_param("s", $user);
		$checkQuery->execute();
		$result = $checkQuery->get_result();

		echo "<!DOCTYPE html>
			<html>
			<head>
			<title>User's Posts</title>
			<link rel='stylesheet' type='text/css' href='styleDB.css'>
			</head>
			<body>";
		echo "<table><tr><th>" .$user. "'s posts</th></tr>";

		while ($row = $result->fetch_assoc()) {
			echo "<tr><td>" .$row['content']. "</td></tr>";
		 }
		echo "</table>";
		echo "</body>
			</html>";
		$result->free();
	}

	if(!empty($_POST['users'])){
		viewPosts($_POST['users'], $mysqli);
	}

	$mysqli->close();

?>