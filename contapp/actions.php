<?php
//header("Content-Type: text/plain");

require_once ( "config.php" );
require_once ( "classes/Contact.php" );

session_start();

$userid = isset( $_SESSION['userid'] ) ? $_SESSION['userid'] : "";
if(!$userid || $userid == "") {
	echo -1 ;
}
elseif (isset($_GET['load'])) {
	echo json_encode(Contact::fetchByUserid($userid));
}
elseif (isset($_GET['add'])) {
	echo Contact::insertFromPOST($_POST);
}
elseif (isset($_GET['edit']) && isset($_POST['json'])) {
	$a = objectToArray(json_decode($_POST['json'])) ;
	
	if (!empty($a['contactName']) && (!empty($a['address']) || !empty($a['email']))) {
		$contact = new Contact();
		$contact->contactName = filter($_POST['contactName'], FILTER_SANITIZE_STRING);
		$contact->address = filter($_POST['address'], FILTER_SANITIZE_STRING);
		$contact->email = filter($_POST['email'], FILTER_SANITIZE_EMAIL);
		
		echo $user->edit($_GET['edit']);
	}
	
}
elseif (isset($_GET['del'])) {
	echo Contact::deleteByContactid($_GET['del'], $userid);	
}

?>