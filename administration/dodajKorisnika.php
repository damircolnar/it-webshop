<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Dodaj Korisnika';
include_once 'header.php'; 

if(!empty($_POST)) {
	$query = "INSERT INTO users(fullName, username, email, password, gradMjesto, postanskiBroj, role, activated) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $db->prepare($query);
	if(!$stmt) {
		echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
	} else {
		$stmt->bind_param('sssssiii', $_POST['fullName'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['gradMjesto'], $_POST['postanskiBroj'], $_POST['role'], $_POST['activated']);
		$result = $stmt->execute();
		$userId = $stmt->insert_id;
		header("Location: users.php");
		if(!$result) {
			echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
		}
		$stmt->close();
	}
}
?>

<form action="" method="POST" class="form-group">
	<label for="fullName">Puno Ime korisnika:</label>
	<input type="text" name="fullName" id="fullName" autofocus required class="form-control">

	<label for="username">Korisničko ime:</label>
	<input type="text" name="username" id="username" required class="form-control">

	<label for="email">Email adresa:</label>
	<input type="email" name="email" id="email" required class="form-control">

	<label for="password">Lozinka:</label>
	<input type="password" name="password" id="password" required class="form-control">

	<label for="gradMjesto">Grad ili Mjesto stanovanja:</label>
	<input type="text" name="gradMjesto" id="gradMjesto" class="form-control">

	<label for="postanskiBroj">Poštanski broj:</label>
	<input type="number" name="postanskiBroj" id="postanskiBroj" class="form-control">
	
	<label for="role">Ovlasti:</label>
	<select name="role" id="role" required class="form-control">
		<option value="" style="background-color: blue; color: white;">Odaberite jednu od opcija:</option>
		<option value="1">Administratorske ovlasti</option>
		<option value="0">Bez administratorskih ovlasti</option>
	</select>

	<label for="activated">Korisnički račun aktiviran</label>
	<select name="activated" id="activated" required class="form-control">
		<option value="" style="background-color: blue; color: white;">Odaberite jednu od opcija:</option>
		<option value="1">Korisnički račun aktiviran</option>
		<option value="0">Korisnički račun nije aktiviran</option>
	</select><br>

	<button type="submit" class="btn btn-primary">Dodaj</button>
</form>

<?php
include_once 'footer.php';
?>