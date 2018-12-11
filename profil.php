<?php
session_start();
ob_start();
if(!isset($_SESSION['memberUsername'])) {
	header("Location: prijava.php");
}

$_pageTitle = 'Moj Profil';
$_pageDesicription = 'Ovdje možete uređivati profil i pregledavati ga';
include_once 'header.php';

$query = 'SELECT * FROM users WHERE id = ' . $_SESSION['uid'];
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
}

while($user = $result->fetch_assoc()) {
	echo '<strong>ID: </strong>' . $user['id'] . '<br>';
	echo '<strong>Puno ime: </strong>' . $user['fullName'] . '<br>';
	echo '<strong>Korisničko ime: </strong>' . $user['username'] . '<br>';
	echo '<strong>Email adresa: </strong>' . $user['email'] . '<br>';
	echo '<strong>Grad ili Mjesto stanovanja: </strong>' . $user['gradMjesto'] . ', ' . $user['postanskiBroj'] . '<br>';
	if($user['activated'] == 0) {
		echo '<strong style="color: red;">Korisnički račun nije aktviran!</strong><br>';
	} else {
		echo '<strong style="color: green">Korisnički račun je aktiviran!</strong><br>';
	}
}
?>

<br>
<a href="urediProfil.php?id=<?php echo $_SESSION['uid']; ?>" class="uredi-btn">Uredi profil</a>

<?php
include_once 'footer.php';
?>