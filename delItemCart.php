<?php
session_start();
ob_start();
if(!isset($_SESSION['memberUsername'])) {
	header("Location: prijava.php");
}

$_pageTitle = 'Brisanje iz Košarice';
$_pageDesicription = '';
$productId = $_GET['id'];
include_once 'header.php';

$query = "DELETE FROM cart_items WHERE productId = ?";
$stmt = $db->prepare($query);
if(!$stmt) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$stmt->bind_param('i', $productId);
	$result = $stmt->execute();
	if(!$result) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
	}
	$stmt->close();
}

$query1 = "UPDATE products SET quantity = quantity + 1 WHERE id = ?";
$stmt1 = $db->prepare($query1);
if(!$stmt1) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$stmt1->bind_param('i', $productId);
	$result1 = $stmt1->execute();
	header("Location: kosarica.php");
	if(!$result1) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt1->connect_error;
	}
	$stmt1->close();
}

include_once 'footer.php';
?>