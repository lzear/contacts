<?php
session_start();
$userId = isset( $_SESSION['userid'] ) ? $_SESSION['userid'] : "";

if (!$userId || $userId == "") {
	header ("Location: login.php");
} else {
	header ("Location: book.php");
}
?>