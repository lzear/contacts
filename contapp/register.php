<?php

require ( "config.php" );
require ( "classes/User.php" );

$results = array();
$results['message'] = "" ;
$flag = false ;
if(isset($_POST['register'])) {

	if(is_null($_POST['username']) || $_POST['username'] == "" || !preg_match(USERNAME_PATTERN, $_POST['username'])) {
		if ($flag)
		$results['message'] .= "<br/>";
		$results['message'] .= "Invalid username";
		$flag = true ;
	}
	elseif(User::fetchByUsername($_POST['username'])) {
		if ($flag)
		$results['message'] .= "<br/>";
		$results['message'] .= "Username is already used";
		$flag = true ;
	}
	if(!isset($_POST['password']) || is_null($_POST['password']) || $_POST['password'] == "" || !preg_match(PASSWORD_PATTERN, $_POST['password'])) {
		if ($flag)
		$results['message'] .= "<br/>";
		$results['message'] .= "Invalid password (length from 6 to 20)";
		$flag = true ;
	}
	if(!isset($_POST['password2']) || is_null($_POST['password2']) || $_POST['password2'] == "" || $_POST['password2'] != $_POST['password']) {
		if ($flag)
		$results['message'] .= "<br/>";
		$results['message'] .= "Passwords must match";
		$flag = true ;
	}
	
	if ($flag) {
		require("templates/register.php");
		return;
	}
	
	else {

		$user = new User();
		$user->username = (string)$_POST['username'];
		$user->password = md5((string)$_POST['password']);

		$user->insert();
		
		$results['message'] = "Registration successful !<br/>You can now log in";
		require("templates/login.php");
		return;
	}
}
require("templates/register.php");
?>