<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Dodaj izdvojeni proizvod';
include_once 'header.php';

echo '<a href="topProducts.php" class="btn btn-primary">Natrag na izdvojene proizvode</a><br><br>'; 

if(!empty($_POST)) {
	$query = "INSERT INTO top_products(name, desicription, price) VALUES (?, ?, ?)";
	$stmt = $db->prepare($query);
	if(!$stmt) {
		echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
	} else {
		$stmt->bind_param('ssi', $_POST['name'], $_POST['desicription'], $_POST['price']);
		$result = $stmt->execute();
		header("Location: topProducts.php");
		if(!$result) {
			echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
		}
		$stmt->close();
	}
}
$db->close();
?>

<form action="" method="POST" class="form-group">
	<label for="name">Proizvod</label>
	<input type="text" name="name" id="name" autofocus required class="form-control">

	<label for="desicription">Opis</label>
	<textarea name="desicription" id="desicription" class="form-control"></textarea>

	<label for="price">Cijena:</label>
	<input type="number" name="price" id="price" required class="form-control"><br>

	<button type="submit" class="btn btn-primary">Dodaj</button>
</form>

<?php
include_once 'footer.php';
?>