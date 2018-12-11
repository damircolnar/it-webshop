<?php
session_start();
ob_start();
if(!isset($_SESSION['memberUsername'])) {
	header("Location: prijava.php");
}

$_pageTitle = 'Aktivacija korisničkog računa';
$_pageDesicription = '';
include_once 'header.php';

if(!isset($_SESSION['memberUsername'])) {
	header("Location: prijava.php");
} else {
	$query = 'SELECT * FROM users WHERE id = ' . $_SESSION['uid'];
	$result = $db->query($query);
	if(!$result) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
	}

	while($user = $result->fetch_assoc()) {
		if($user['activated'] == 0) {
			mail($user['email'], 'Activate profile account', 'activate.php?id=' . $_SESSION['uid'] . $user['password']);
		} else if($user['activated'] == 1) {
			header("Location: index.php");
		}
	}
	echo '<h1>Poslan Vam je email sa verifikacijskim linkom</h1>';
}

include_once 'footer.php';
?>