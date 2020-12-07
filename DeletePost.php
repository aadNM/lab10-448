<?php
	libxml_use_internal_errors(true);
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	$mysqli = new mysqli("mysql.eecs.ku.edu", "abdouldiallo", "LAB10eecs44820", "abdouldiallo");

	if($mysqli->connect_errno){
		printf("Connect failed: %s\n", $mysql->connect_errno);
		exit();
	}

	/*$query1 = "SELECT * FROM Posts";
	$sqlCount = mysql_query($mysqli, $query1);
	$totalRows = mysql_num_rows($sqlCount);*/
	$idsList = "Post ids being deleted: ";

	if(!empty($_POST['delete'])) {
	    foreach($_POST['delete'] as $id) {
	   		$idsList .= $id. ",";
		   $sql = "DELETE FROM Posts WHERE post_id =?";
			$delQuery = $mysqli->prepare($sql);
			$delQuery->bind_param("s", $id);
			$delQuery->execute();
		}
	    
	}

	echo substr($idsList, 0, -2);
	$mysqli->close();
?>