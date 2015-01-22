<?php

require ( "config.php" );
require ( "classes/User.php" );

session_start();
session_destroy();
session_start();

$results = array();

if(isset($_POST['login'])) {
	if(!isset($_POST['username']) || is_null($_POST['username']) || $_POST['username'] == ""
	|| !isset($_POST['password']) || is_null($_POST['password']) || $_POST['password'] == "" ) {
		$results['message'] = "Invalid username or password";
		require("templates/login.php");
		return;
	}
	
	$user = User::fetchByLogin($_POST['username'], md5($_POST['password']));
	if(!$user) {
		$results['message'] = "Invalid username or password";
		require("templates/login.php");
		return;
	}
	
	$_SESSION['userid'] = $user->userid;
	$_SESSION['username'] = $user->username;

	header("Location: book.php");
}

require("templates/login.php");

?>