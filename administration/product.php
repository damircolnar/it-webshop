<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Detalji Proizvoda';
$productId = $_GET['id'];
include_once 'header.php';

echo '<a href="products.php" class="btn btn-primary">Natrag na proizvode</a><br><br>';

$query = "SELECT * FROM products WHERE id = ?";
$stmt = $db->prepare($query);
if(!$stmt) {
	echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
} else {
	$stmt->bind_param('i', $productId);
	$stmt->bind_result($id, $name, $desicription, $productImg, $price, $quantity, $categoryId);
	$result = $stmt->execute();
	if(!$result) {
		echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
	} else {
		$stmt->fetch();
		$stmt->close();
	}
}
?>

<dl class="row">
	<dt class="col-sm-3">ID:</dt>
	<dd class="col-sm-9"><?php echo $id; ?></dd>

	<dt class="col-sm-3">Ime proizvoda:</dt>
	<dd class="col-sm-9"><?php echo $name; ?></dd>

	<dt class="col-sm-3">Opis proizvoda:</dt>
	<dd class="col-sm-9"><?php echo $desicription; ?></dd>

	<dt class="col-sm-3">Cijena:</dt>
	<dd class="col-sm-9"><?php echo $price . ' kn'; ?></dd>

	<dt class="col-sm-3">Količina:</dt>
	<dd class="col-sm-9"><?php echo $quantity . ' KOM'; ?></dd>

	<?php
	if($categoryId == 1) { ?>
		<dt class="col-sm-3">Kategorija:</dt>
		<dd class="col-sm-9">Tipkovnice</dd>
	<?php } elseif($categoryId == 2) { ?>
		<dt class="col-sm-3">Kategorija:</dt>
		<dd class="col-sm-9">Software</dd>
	<?php } ?>
</dl>

<a href="obrisiProizvod.php?id=<?php echo $id; ?>" class="btn btn-danger">Obriši</a>
<a href="urediProizvod.php?id=<?php echo $id; ?>" class="btn btn-secondary">Uredi</a>

<?php
include_once 'footer.php';
?>