<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Uređivanje korisnika';
$userId = $_GET['id'];
include_once 'header.php';

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $db->prepare($query);
if(!$stmt) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$stmt->bind_param('i', $userId);
	$stmt->bind_result($id, $fullName, $username, $email, $password, $gradMjesto, $postanskiBroj, $role, $activated);
	$result = $stmt->execute();
	if(!$result) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
	} else {
		$stmt->fetch();
		$stmt->close();
	}
}
?>

<a href="users.php" class="btn btn-primary">Natrag na korisnike</a><br><br>

<?php
if(!empty($_POST)) {
	$query = "UPDATE users SET fullName = ?, username = ?, email = ?, password = ?, gradMjesto = ?, postanskiBroj = ?, role = ?, activated = ? WHERE id = ?";
	$stmt = $db->prepare($query);
	if(!$stmt) {
		echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
	} else {
		$passwordHash = md5($_POST['password']);
		$stmt->bind_param('sssssiiii', $_POST['fullName'], $_POST['username'], $_POST['email'], $passwordHash, $_POST['gradMjesto'], $_POST['postanskiBroj'], $_POST['role'], $_POST['activated'], $userId);
		$result = $stmt->execute();
		header("Location: users.php");
		if(!$result) {
			echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
		}
		$stmt->close();
	}
}
?>

<form action="" method="POST" class="form-group">
	<label for="name">Puno Ime korisnika:</label>
	<input type="text" name="fullName" id="fullName" value="<?php echo $fullName; ?>" autofocus required class="form-control">

	<label for="username">Korisničko ime:</label>
	<input type="text" name="username" id="username" value="<?php echo $username; ?>" required class="form-control">

	<label for="email">Email adresa:</label>
	<input type="email" name="email" id="email" value="<?php echo $email; ?>" required class="form-control">

	<label for="password">Lozinka:</label>
	<input type="password" name="password" id="password" value="<?php echo $password; ?>" required class="form-control">

	<label for="gradMjesto">Grad ili Mjesto stanovanja:</label>
	<input type="text" name="gradMjesto" id="gradMjesto" value="<?php echo $gradMjesto; ?>" required class="form-control">

	<label for="postanskiBroj">Poštanski broj:</label>
	<input type="number" name="postanskiBroj" id="postanskiBroj" value="<?php echo $postanskiBroj; ?>" required class="form-control">

	<label for="role">Ovlasti:</label>
	<input type="number" name="role" id="role" value="<?php echo $role; ?>" class="form-control">

	<label for="activated">Račun aktiviran:</label>
	<input type="number" name="activated" id="activated" value="<?php echo $activated; ?>" class="form-control"><br>

	<button type="submit" class="btn btn-primary">Promjeni</button>
</form>

<?php
include_once 'footer.php';
?>