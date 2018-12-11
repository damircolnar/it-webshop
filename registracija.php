<?php
session_start();
ob_start();
if(isset($_SESSION['memberUsername'])) {
	header("Location: index.php");
}

$_pageTitle = 'Registracija novog korisnika';
$_pageDesicription = '';
include_once 'header.php';

echo '<h1>' . $_pageTitle . '</h1>';

if(!empty($_POST)) {
	$query = "INSERT INTO users(fullName, username, email, password, gradMjesto, postanskiBroj) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $db->prepare($query);
	if(!$stmt) {
		echo 'Došlo je do greške prilikom pripremanja parametara ' . $db->error;
	} else {
		$passwordHash = md5($_POST['password']);
		$stmt->bind_param('sssssi', $_POST['fullName'], $_POST['username'], $_POST['email'], $passwordHash, $_POST['gradMjesto'], $_POST['postanskiBroj']);
		$result = $stmt->execute();
		$userId = $stmt->insert_id;
		$_SESSION['memberUsername'] = $_POST['username'];
		echo '<strong style="color: green;">Korisnički račun je uspješno kreiran! <a href="prijava.php">Prijava</a></strong>';
		session_destroy();
		if(!$result) {
			echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
		}
		$stmt->close();
	}
}
?>

<form action="" method="POST">
	<label for="fullName">Puno Ime i Prezime:</label><br>
	<input type="text" name="fullName" id="fullName" autofocus required><br>

	<label for="username">Korisničko ime / Username:</label><br>
	<input type="text" name="username" id="username" required><br>

	<label for="email">Email:</label><br>
	<input type="email" name="email" id="email" required><br>
	
	<label for="password">Lozinka / Password:</label><br>
	<input type="password" name="password" id="password" required><br>

	<label for="gradMjesto">Grad ili Mjesto stanovanja:</label><br>
	<input type="text" name="gradMjesto" id="gradMjesto" required><br>

	<label for="postanskiBroj">Poštanski Broj:</label><br>
	<input type="number" name="postanskiBroj" id="postanskiBroj" required><br><br>

	<button type="submit" class="prijava-btn">Registracija</button>
</form>

<?php
include_once 'footer.php';
?>