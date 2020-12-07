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


	function ValidUser($userName, $userPost, $mysqli){
		$sql = "SELECT * FROM Users WHERE user_id =?";
	    $checkQuery = $mysqli->prepare($sql);
	    $checkQuery->bind_param("s", $userName);
	    $checkQuery->execute();
	    $resultCheck = $checkQuery->get_result();

	    if($existingName = $resultCheck->fetch_assoc()){
	        echo "<p>Adding post.....<p>";
	      	AddPost($userName, $userPost, $mysqli);
	    }else{
	    	echo "<p>User doesn't exists<br>Post not saved<br>Please,
	      		use a valide username.</p>";
	      	echo "<br><a href='./CreatePosts.html'>Go Back</a>";
	    }

	    $resultCheck->free();
	}


	function AddPost($userId, $userPost, $mysqli){
		$sql = "INSERT INTO Posts (content, author_id) VALUES (?, ?)";
		$addQuery = $mysqli->prepare($sql);
	    $addQuery->bind_param("ss", $userPost, $userId);
	    $addQuery->execute();
	    $resultCheck = $addQuery->get_result();
	    
	    $sql1 = "SELECT * FROM Posts WHERE author_id =?";
	    $checkQuery = $mysqli->prepare($sql1);
	    $checkQuery->bind_param("s", $userId);
	    $checkQuery->execute();
	    $resultCheck = $checkQuery->get_result();

	    if($existingName = $resultCheck->fetch_assoc()){
	      echo "<p>Post added</p>";
	    }
	    echo "<br><a href='./CreatePosts.html'>Go Back</a>";
	}
		


	 if (!empty(htmlspecialchars($_POST['userName'])) && !empty(htmlspecialchars($_POST['post-content']))){
	    echo "<p>User value sent</p>";
	    ValidUser(htmlspecialchars($_POST['userName']),htmlspecialchars($_POST['post-content'], $mysqli)); 
	 }else{
	    echo "<p>Please, put a value for all fields....</p>";
    	echo "<br><a href='./CreatePosts.html'>Go Back</a>";
	 }	

	$mysqli->close();
?>