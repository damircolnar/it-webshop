<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Proizvodi';
include_once 'header.php';

$query = "SELECT * FROM products";
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
}
?>

<a href="dodajProizvod.php" class="btn btn-primary">Dodaj Proizvod</a><br><br>

<table class="table table-sm">
	<thead class="thead-dark">
		<tr>
			<th>ID:</th>
			<th>Name:</th>
			<th>Količina:</th>
		</tr>
	</thead>

	<tbody>
		<?php
		while($product = $result->fetch_assoc()) { ?>
			<tr>
				<td><?php echo $product['id']; ?></td>
				<td><a href="product.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></td>
				<td><?php echo $product['quantity'] . ' KOM'; ?></td>
			</tr>
		<?php } ?>
	</tbody>

	<tfoot>
		<th colspan="2" style="background-color: #111; color: #FFFFFF;">Sveukupno na skladištu:</th>
		<td style="background-color: aqua;"><?php 
		$sumQuery = "SELECT SUM(quantity) FROM products";
		$sumStmt = $db->prepare($sumQuery);
		if(!$sumStmt) {
			echo 'Došlo je do greške prilikom pripremanja parametara ' . $db->error;
		} else {
			$sumStmt->bind_result($quantitySum);
			$sumResult = $sumStmt->execute();
			if(!$sumResult) {
				echo 'Došlo je do greške prilikom izvršavanja upita ' . $sumStmt->connect_error;
			} else {
				$sumStmt->fetch();
				$sumStmt->close();
			}
		}
		?>
			<?php echo $quantitySum . ' KOM'; ?>
		</td>
	</tfoot>
</table>

<?php
include_once 'footer.php';
?>