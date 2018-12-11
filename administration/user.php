<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Detalji korisnika';
$userId = $_GET['id'];
include_once 'header.php';

echo '<a href="users.php" class="btn btn-primary">Natrag na korisnike</a><br><br>';

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $db->prepare($query);
if(!$stmt) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$stmt->bind_param('i', $userId);
	$stmt->bind_result($id, $fullName, $username, $email, $password, $gradMjesto, $postanskiBroj, $role, $activated);
	$result = $stmt->Execute();
	if(!$result) {
		echo 'Došlo je do grešk prilikom izvršavanja upita ' . $stmt->connect_error;
	} else {
		$stmt->fetch();
		$stmt->close();
	}
}
?>

<dl class="row">
	<dt class="col-sm-3">ID:</dt>
	<dd class="col-sm-9"><?php echo $id; ?></dt>

	<dt class="col-sm-3">Puno Ime:</dt>
	<dd class="col-sm-9"><?php echo $fullName; ?></dt>

	<dt class="col-sm-3">Korisničko ime:</dt>
	<dd class="col-sm-9"><?php echo $username; ?></dt>

	<dt class="col-sm-3">Email:</dt>
	<dd class="col-sm-9"><?php echo $email; ?></dt>

	<dt class="col-sm-3">Grad ili Mjesto stanovanja:</dt>
	<dd class="col-sm-9"><?php echo $gradMjesto; ?></dt>

	<dt class="col-sm-3">Poštanski broj::</dt>
	<dd class="col-sm-9"><?php echo $postanskiBroj; ?></dt>

	<dt class="col-sm-3">Ovlasti:</dt>
	<dd class="col-sm-9"><?php 
	if($role == 0) { ?>
		Nema administratorse ovlasti!
	<?php } else { ?>
		Ima administratorkse ovlasti!
	<?php } ?></dt>
	</dd>

	<dt class="col-sm-3">Aktiviran:</dt>
	<dd class="col-sm-9">
		<?php
		if($activated == 0) {?>
			Korisnički račun nije aktiviran!
		<?php } else { ?>
			Korisnički račun je aktiviran!
		<?php } ?>
	</dt>
</dl>

<a href="obrisiKorisnika.php?id=<?php echo $id; ?>" class="btn btn-danger">Obriši korisnika</a>
<a href="urediKorisnika.php?id=<?php echo $id; ?>" class="btn btn-secondary">Uredi korisnika</a>

<?php
include_once 'footer.php';
?>