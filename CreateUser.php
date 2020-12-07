<?php
  libxml_use_internal_errors(true);
  error_reporting(E_ALL);
  ini_set("display_errors", 1);


  $mysqli = new mysqli("mysql.eecs.ku.edu", "abdouldiallo", "LAB10eecs44820", "abdouldiallo");

  if($mysqli->connect_errno){
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }else {
    printf ("Connection successful\n");
  }

  function ValidUser($newUser, $mysqli){ 
    $sql = "SELECT * FROM Users WHERE user_id =?";
    $checkQuery = $mysqli->prepare($sql);
    $checkQuery->bind_param("s", $newUser);
    $checkQuery->execute();
    $resultCheck = $checkQuery->get_result();

    if($existingName = $resultCheck->fetch_assoc()){
      echo "<p>User Already Exists</p>";
      echo "<br><a href='./CreateUser.html'>Go Back</a>";
    }else{
      echo "<p>Adding user.....<p>";
      AddUser($newUser, $mysqli);
    }

    $resultCheck->free();
  }

  function AddUser($userId, $mysqli){
    $sql = "INSERT INTO Users VALUES (?)";
    $addQuery = $mysqli->prepare($sql);
    $addQuery->bind_param("s", $userId);
    $addQuery->execute();
    $resultCheck = $addQuery->get_result();
    
    $sql1 = "SELECT * FROM Users WHERE user_id =?";
    $checkQuery = $mysqli->prepare($sql1);
    $checkQuery->bind_param("s", $userId);
    $checkQuery->execute();
    $resultCheck = $checkQuery->get_result();

    if($existingName = $resultCheck->fetch_assoc()){
      echo "<p>User added</p>";
    }
    echo "<br><a href='./CreateUser.html'>Go Back</a>";
    $resultCheck->free();
  }


 if (!empty(htmlspecialchars($_POST['userName']))){
    //echo "<p>User value sent</p>";
    ValidUser(htmlspecialchars($_POST['userName'], $mysqli)); 
  }else{
    echo "<p>Please enter a user name....</p>";
    echo "<br><a href='./CreateUser.html'>Go Back</a>";
  }

  $mysqli->close();
 ?>
