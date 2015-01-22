<?php
require_once ( "config.php" );
require_once ( "classes/User.php" );
require_once ( "classes/Contact.php" );

session_start();


$userid = isset( $_SESSION['userid'] ) ? $_SESSION['userid'] : "";
if(!$userid || $userid == "") {
	header("Location: login.php");
}

$results = array();

$contacts = Contact::fetchByUserid($userid);
$userinfo = User::fetchByUserid($userid);

$results['userinfo'] = $userinfo;
$results['contacts'] = $contacts;

//echo json_encode($results, JSON_FORCE_OBJECT);

require("templates/book.php");
?> 

