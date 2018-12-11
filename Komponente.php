<?php
session_start();
ob_start();

$_pageTitle = 'Komponente';
$_pageDesicription = '';
include_once 'header.php';

echo '<h1>' . $_pageTitle . '</h1>';
echo $_pageDesicription . '<br><br>';

$query = "SELECT products.id, products.name, products.desicription, products.productImg, products.price, products.quantity, products.categoryId FROM products LEFT JOIN categories ON products.categoryId = categories.id WHERE categories.id = 4";
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->connect_error;
}

while($components = $result->fetch_assoc()) {
	echo '<br><br><h3>' . $components['name'] . '</h3>';
	echo '<strong>' . $components['desicription'] . '</strong><br>';
	echo 'Cijena: ' . $components['price'] . ' kn<br>'; ?>
	<img src="images/<?php echo $components['productImg']; ?>" alt="productImg" width="100" height="100"><br>
	<?php
	if($components['quantity'] == 0) {
		echo '<strong style="color: red;">Uskoro dolazi!</strong><br>';
	} else {
		echo 'Stanje na skladištu : ' . $components['quantity'] . ' KOM<br>'; 
		if(isset($_SESSION['memberUsername'])) { ?>
			<a href="addtocart.php?id=<?php echo $components['id']; ?>">Dodaj u Košaricu</a>
		<?php } ?>
	<?php } ?>
	<a href="product.php?id=<?php echo $components['id']; ?>">Pogledaj proizvod</a>
<?php }

include_once 'footer.php';
?>