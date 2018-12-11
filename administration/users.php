<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Korisnici';
include_once 'header.php';

$query = "SELECT * FROM users";
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
}
?>

<a href="dodajKorisnika.php" class="btn btn-primary">Dodaj korisnika</a><br><br>

<table class=" table table-sm">
	<thead class="thead-dark">
		<tr>
			<th>ID:</th>
			<th>Username:</th>
			<th>Email:</th>
		</tr>
	</thead>

	<tbody>
		<?php
		while($user = $result->fetch_assoc()) { ?>
			<tr>
				<td><?php echo $user['id']; ?></td>
				<td><a href="user.php?id=<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></td>
				<td><?php echo $user['email']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php
include_once 'footer.php';
?>