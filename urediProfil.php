<?php
session_start();
ob_start();
if(!isset($_SESSION['memberUsername'])) {
	header("Location: prijava.php");
}

$_pageTitle = 'Uredi Profil';
$_pageDesicription = 'Ovdje možete uređivati profil';
$userId = $_SESSION['uid'];
include_once 'header.php'; 

$query = "SELECT id, fullName, username, email, password, gradMjesto, postanskiBroj FROM users WHERE id = ?";
$stmt = $db->prepare($query);
if(!$stmt) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$stmt->bind_param('i', $_SESSION['uid']);
	$stmt->bind_result($id, $fullName, $username, $email, $password, $gradMjesto, $postanskiBroj);
	$result = $stmt->execute();
	if(!$result) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
	} else {
		$stmt->fetch();
		$stmt->close();
	}
}

if(!empty($_POST)) {
	$query = "UPDATE users SET fullName = ?, username = ?, email = ?, password = ?, gradMjesto = ?, postanskiBroj = ? WHERE id = ?";
	$stmt = $db->prepare($query);
	if(!$stmt) {
		echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
	} else {
		$passwordHash = md5($_POST['password']);
		$stmt->bind_param('sssssii', $_POST['fullName'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['gradMjesto'], $_POST['postanskiBroj'], $_SESSION['uid']);
		$result = $stmt->execute();
		echo '<strong style="color: green">Podaci su promjenjeni!</strong>';
		if(!$result) {
			echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
		}
		$stmt->close();
	}
}
?>

<form action="" method="POST">
	<label for="fullName">Puno Ime i Prezime:</label><br>
	<input type="text" name="fullName" id="fullName" value="<?php echo $fullName; ?>" autofocus required><br>

	<label for="username">Korisničko ime / Username:</label><br>
	<input type="text" name="username" id="username" value="<?php echo $username; ?>" required><br>

	<label for="email">Email adresa:</label><br>
	<input type="email" name="email" id="email" value="<?php echo $email; ?>" required><br>

	<label for="password">Lozinka / Password:</label><br>
	<input type="password" name="password" id="password" value="<?php echo $password; ?>" required><br>

	<label for="gradMjesto">Grad ili Mjesto stanovanja:</label><br>
	<input type="text" name="gradMjesto" id="gradMjesto" value="<?php echo $gradMjesto; ?>" required><br>

	<label for="postanskiBroj">Poštanski broj:</label><br>
	<input type="number" name="postanskiBroj" id="postanskiBroj" value="<?php echo $postanskiBroj; ?>" required><br><br>

	<button type="submit" class="uredi-btn">Uredi Profil</button>
</form>

<?php
include_once 'footer.php';
?>