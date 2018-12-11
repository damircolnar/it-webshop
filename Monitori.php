<?php
session_start();
ob_start();

$_pageTitle = 'Monitori';
$_pageDesicription = 'Monitori za igranje';
include_once 'header.php';

echo '<h1>' . $_pageTitle . '</h1>';
echo $_pageDesicription . '<br><br>';

$query = "SELECT products.id, products.name, products.desicription, products.productImg, products.price, products.quantity, products.categoryId FROM products LEFT JOIN categories ON products.categoryId = categories.id WHERE categories.id = 3";
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->connect_error;
}

while($monitori = $result->fetch_assoc()) {
	echo '<br><br><h3 style="color: red;">' . $monitori['name'] . '</h3>';
	echo '<strong>' . $monitori['desicription'] . '</strong><br>';
	echo 'Cijena: ' . $monitori['price'] . ' kn<br>'; ?>
	<img src="images/<?php echo $monitori['productImg']; ?>" alt="productImg" width="100" height="100"><br>
	<?php
	if($monitori['quantity'] == 0) {
		echo '<strong style="color: red;">Uskoro dolazi!</strong><br>';
	} else {
		echo 'Stanje na skladištu : ' . $monitori['quantity'] . ' KOM<br><br>';
		if(isset($_SESSION['memberUsername'])) { ?>
			<a href="addtocart.php?id=<?php echo $monitori['id']; ?>">Dodaj u Košaricu</a>
		<?php } ?>
	<?php } ?>
		<a href="product.php?id=<?php echo $monitori['id']; ?>">Pogledaj Proizvod</a>
<?php }

include_once 'footer.php';
?>