<?php
session_start();
ob_start();
if(!isset($_SESSION['memberUsername'])) {
	header("Location: prijava.php");
}

$_pageTitle = 'Košarica';
$_pageDesicription = 'Ovdje možete pregledavati i uređivati stvari koje su u košarici.';
include_once 'header.php';

$query = 'SELECT * FROM cart_items WHERE userId = ' . $_SESSION['uid'];
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
}

$sumQuery = "SELECT SUM(quantity * price) FROM cart_items WHERE userId = ?";
$sumStmt = $db->prepare($sumQuery);
if(!$sumStmt) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$sumStmt->bind_param('i', $_SESSION['uid']);
	$sumStmt->bind_result($totalPrice);
	$sumResult = $sumStmt->execute();
	if(!$sumStmt) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $sumStmt->connect_error;
	} else {
		$sumStmt->fetch();
		$sumStmt->close();
	}
}

if($result->num_rows == 0) {
	echo '<strong style="color: red;">Trenutno nemate ništa u košarici!</strong>';
} else { ?>
	<table class="cart-items">
		<thead>
			<tr>
				<th>ID:</th>
				<th>Proizvod:</th>
				<th>Količina:</th>
				<th>Cijena:</th>
				<th>OP:</th>
			</tr>
		</thead>

		<tbody>
			<?php
			while($cartItems = $result->fetch_assoc()) { 
				?>
				<tr>
					<td><?php echo '<strong>' . $cartItems['id'] . '</strong>'; ?></td>
					<td><?php echo $cartItems['name']; ?></td>
					<td><?php echo $cartItems['quantity']; ?></td>
					<td><?php echo $cartItems['price'] . ' kn'; ?></td>
					<td><a href="delItemCart.php?id=<?php echo $cartItems['productId']; ?>">Obriši</a></td>
				</tr>
			<?php } ?>
		</tbody>

		<tfoot>
			<th colspan="4">Sveukupno:</th>
			<td><?php echo $totalPrice . ' kn'; ?></td>
		</tfoot>
	</table><br>
	<a href="placanje.php?id=<?php echo $_SESSION['uid']; ?>" class="checkout-btn">Plaćanje</a>
<?php }

include_once 'footer.php';
?>