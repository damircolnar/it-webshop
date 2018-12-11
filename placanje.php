<?php
session_start();
ob_start();
if(!isset($_SESSION['memberUsername'])) {
	header("Location: prijava.php");
}

$_pageTitle = 'Plaćanje';
$_pageDesicription = '';
include_once 'header.php';

$querySelect = 'SELECT * FROM cart_items WHERE userId = ' . $_SESSION['uid'];
$resultSelect = $db->query($querySelect);
/*if(!resultSelect) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
}*/

$query = "INSERT INTO invoices(fullName, items, quantity, price, userId) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->prepare($query);
if(!$stmt) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	while($items = $resultSelect->fetch_assoc()) {
		$stmt->bind_param('ssiii', $_SESSION['fullName'], $items['name'], $items['quantity'], $items['price'], $_SESSION['uid']);
		$result = $stmt->execute();
	}
	echo 'Vaša narudžba je prihvaćena!';
	if(!$result) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
	}
	$stmt->close();
}

$query1 = 'DELETE FROM cart_items WHERE userId = ' . $_SESSION['uid'];
$result1 = $db->query($query1);
if(!$result1) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
}

include_once 'footer.php';
?>