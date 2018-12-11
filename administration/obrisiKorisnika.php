<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Brisanje korisnika';
$userId = $_GET['id'];
include_once 'header.php';

$query = "DELETE FROM users WHERE id = ?";
$stmt = $db->prepare($query);
if(!$stmt) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$stmt->bind_param('i', $userId);
	$result = $stmt->execute();
	header("Location: users.php");
	if(!$result) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
	}
	$stmt->close();
}
$db->close();


include_once 'footer.php';
?>