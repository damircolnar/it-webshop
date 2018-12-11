<?php
session_start();
ob_start();

$_pageTitle = 'Detalji proizvoda';
$_pageDesicription = '';
$productId = $_GET['id'];
include_once 'header.php';

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

echo '<h2>' . $name . '</h2>';
echo '<h5>' . $desicription . '</h5>'; ?>
<img src="images/<?php echo $productImg; ?>" alt="productImg" class="product-img"><br>
<?php
echo '<strong>Cijena proizvoda: ' . $price . ' KN</strong><br>';
echo 'Količina na skladištu: ' . $quantity . '<br><br>'; ?>
<a href="addtocart.php?id=<?php echo $id; ?>" style="font-size: 20px; text-decoration: none; font-weight: bold;">Dodaj u Košaricu</a>

<?php
include_once 'footer.php';
?>