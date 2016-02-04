<?php
	require("database.php");
	session_start();// Starting Session
	// Storing Session
	$username=$_SESSION['login_user'];
	$user_id=$_SESSION['user_id'];
	// SQL Query To Fetch Complete Information Of User
	$sql="SELECT * FROM account_info WHERE user_id = ".$user_id."";
	$res = odbc_exec($conn,$sql);
	$row = odbc_fetch_array($res);
	$login_session = $row['user_id'];

	$Fname = $row['firstname'];
	$fullname = $row['firstname']." ".$row['middlename']." ".$row['lastname'];

	if(!isset($login_session)){
		odbc_close($connection); // Closing Connection
		header('Location: ../index.php'); // Redirecting To Home Page
		exit();
	}
?>