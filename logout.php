<?php
session_start();
ob_start();

if(isset($_SESSION['memberUsername'])) {
	session_destroy();
	header("Location: prijava.php");
} else {
	header("Location: index.php");
}

?>