<?php
ini_set( "display_errors", true );
if(!defined("CONFIG"))
{
	define( "CONFIG", "yes");
	define( "DB_DSN", "mysql:host=localhost;dbname=contacts" );
	define( "DB_USERNAME", "root" );
	define( "DB_PASSWORD", "" );
	define( "EMAIL_PATTERN", '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$/');
    define( "USERNAME_PATTERN", '/^[a-zA-Z0-9._-]+$/');
    define( "PASSWORD_PATTERN", '/^.{6,20}$/');
}
?>
