<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /whsop/prijava.php");
}

$_pageTitle = 'Kategorije';
include_once 'header.php';

$query = "SELECT * FROM categories";
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
}
?>

<table class="table table-sm">
	<thead class="thead-dark">
		<tr>
			<th>ID:</th>
			<th>Ime:</th>
			<th>Opis:</th>
		</tr>
	</thead>

	<tbody>
		<?php
		while($category = $result->fetch_assoc()) { ?>
			<tr>
				<td><?php echo $category['id']; ?></td>
				<td><?php echo $category['name']; ?></td>
				<td><?php echo $category['desicription']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php
include_once 'footer.php';
?>