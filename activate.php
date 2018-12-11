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
		echo 'Došlo je do greške prilikom izvršavanja parametara ' . $db->error;
	}

	while($user = $result->fetch_assoc()) {
		if($user['activated'] == 0 && $_GET['id'] == $_SESSION['uid'] . $user['password']) {
			$queryActivate = 'UPDATE users SET activated = 1 WHERE id = ?';
			$stmtActivate = $db->prepare($queryActivate);
			if(!$stmtActivate) {
				echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
			} else {
				$stmtActivate->bind_param('i', $_SESSION['uid']);
				$resultActivate = $stmtActivate->execute();
				header("Location: index.php");
				if(!$resultActivate) {
					echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmtActivate->connect_error;
				}
				$stmtActivate->close();
			}
		} else {
			echo 'Korisnički račun je već aktiviran<br>Aktivacijski link je istekao ili je nevažeći.<br>';
			echo '<a href="index.php">Natrag na početnu stranicu</a>';
		}
	}
}

include_once 'footer.php';
?>