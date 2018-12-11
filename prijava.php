<?php
session_start();
ob_start();
if(isset($_SESSION['memberUsername'])) {
	header("Location: index.php");
}

$_pageTitle = 'Prijava korisnika';
$_pageDesicription = '';
include_once 'header.php';

?>

<form action="" method="POST">
	<label for="username">Korisničko ime / Username:</label><br>
	<input type="text" name="username" id="username" autofocus required><br>

	<label for="password">Lozinka / Password:</label><br>
	<input type="password" name="password" id="password" required><br><br>

	<button type="submit" class="prijava-btn">Prijava</button>
</form>
<a style="color: blue; text-decoration: none;" href="registracija.php">Registracija</a>

<?php
if(!empty($_POST)) {
	$query = "SELECT * FROM users";
	$result = $db->query($query);
	if(!$result) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->connect_error;
	}

	while($user = $result->fetch_assoc()) {
		if($_POST['username'] == $user['username'] && md5($_POST['password'] == $user['password'])) {
			$_SESSION['memberUsername'] = $user['username'];
			$_SESSION['fullName'] = $user['fullName'];
			$_SESSION['uid'] = $user['id'];
			$_SESSION['role'] = $user['role'];
			header("Location: index.php");
		}
	}
	echo '<br><strong style="color: red;">Krivo ste unijeli korisničko ime ili lozinku!</strong>';
}

include_once 'footer.php';
?>