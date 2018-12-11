<?php
session_start();
ob_start();
if(!isset($_SESSION['memberUsername'])) {
	header("Location: prijava.php");
}

$_pageTitle = 'Računi';
$_pageDesicription = '';
include_once 'header.php';

$query = 'SELECT * FROM invoices WHERE userId = ' . $_SESSION['uid'];
$result = $db->query($query);

while($invoice = $result->fetch_assoc()) {
	echo '<h3>Broj Računa: ' . $invoice['id'] . '</h3>';
	echo 'Ime i Prezime kupca: ' . $invoice['fullName'] . '<br>';
	echo 'Kupljeni Proizvodi: <br>' . $invoice['items'] . '<br>';
	echo 'Količina: ' . $invoice['quantity'] . ' KOM<br>';
	echo 'Cijena: ' . $invoice['price'] . ' KN<hr><br>';
}

include_once 'footer.php';
?>