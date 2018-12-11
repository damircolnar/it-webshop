<?php
session_start();
ob_start();
if(!isset($_SESSION['memberUsername'])) {
	header("Location: prijava.php");
}

$_pageTitle = 'Add to Cart';
$_pageDesicription = '';
$productId = $_GET['id'];
$quantityAddToCart = 1;
include_once 'header.php';

$query = "SELECT name, quantity, price FROM products WHERE id = ?";
$stmt = $db->prepare($query);
if(!$stmt) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$stmt->bind_param('i', $productId);
	$stmt->bind_result($name, $quantity, $price);
	$result = $stmt->execute();
	if(!$result) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
	} else {
		$stmt->fetch();
		$stmt->close();
	}
}

if($quantity > 0) {
	$addToCartQuery = "INSERT INTO cart_items(userId, productId, name, quantity, price) VALUES (?, ?, ?, ?, ?)";
	$stmtAdd = $db->prepare($addToCartQuery);
	if(!$stmtAdd) {
		echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
	} else {
		$stmtAdd->bind_param('iisii', $_SESSION['uid'], $productId, $name, $quantityAddToCart, $price);
		$resultAdd = $stmtAdd->execute();
		$cartId = $stmtAdd->insert_id;
		echo '<strong style="color: green;">Proizvod je uspješno dodan u košaricu</strong>';
		if(!$resultAdd) {
			echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmtAdd->connect_error;
		}
		$stmtAdd->close();
	}
} else {
	header("Location: index.php");
}

$updateItemQuantity = "UPDATE products SET quantity = quantity - 1 WHERE id = ?";
$stmtUpdate = $db->prepare($updateItemQuantity);
if(!$stmtUpdate) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$stmtUpdate->bind_param('i', $productId);
	$resultUpdate = $stmtUpdate->execute();
	if(!$resultUpdate) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmtUpdate->connect_error;
	}
	$stmtUpdate->close();
}

include_once 'footer.php';
?>