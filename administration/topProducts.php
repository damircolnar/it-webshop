<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Izdvojeni Proizvodi';
include_once 'header.php';

echo '<a href="dodajBestBuy.php" class="btn btn-primary">Dodaj izdvojeni proizvod</a><br><br>';

$query = "SELECT * FROM top_products";
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
} ?>

<table class="table table-sm">
	<thead class="thead-dark">
		<tr>
			<th>Ime:</th>
			<th>Opis:</th>
			<th>Cijena:</th>
			<th>*</th>
		</tr>
	</thead>

	<tbody>
		<?php
		while($topProduct = $result->fetch_assoc()) { ?>
			<tr>
				<td><?php echo $topProduct['name']; ?></td>
				<td><?php echo $topProduct['desicription']; ?></td>
				<td><?php echo $topProduct['price']; ?></td>
				<td><a href="obrisiBestBuy.php?id=<?php echo $topProduct['id']; ?>" class=" btn btn-danger btn-sm">Obriši</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php
include_once 'footer.php';
?>