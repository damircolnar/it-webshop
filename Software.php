<?php
session_start();
ob_start();

$_pageTitle = 'Software';
$_pageDesicription = 'Sve vezano za software';
include_once 'header.php';

echo '<h1>' . $_pageTitle . '</h1>';
echo $_pageDesicription . '<br><br>';

$query = "SELECT products.id, products.name, products.desicription, products.productImg, products.price, products.quantity, products.categoryId FROM products LEFT JOIN categories ON products.categoryId = categories.id WHERE categories.id = 2";
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->connect_error;
}

while($software = $result->fetch_assoc()) {
	echo '<br><br><h3>' . $software['name'] . '</h3>';
	echo '<strong>' . $software['desicription'] . '</strong><br>';
	echo 'Cijena: ' . $software['price'] . ' kn<br>'; ?>
	<img src="images/<?php echo $software['productImg']; ?>" alt="productImg" width="100" height="100"><br>
	<?php
	if($software['quantity'] == 0) {
		echo '<strong style="color: red;">Uskoro dolazi!</strong><br>';
	} else {
		echo 'Stanje na skladištu : ' . $software['quantity'] . ' KOM<br>'; 
		if(isset($_SESSION['memberUsername'])) { ?>
			<a href="addtocart.php?id=<?php echo $software['id']; ?>">Dodaj u Košaricu</a>
		<?php } ?>
	<?php } ?>
	<a href="product.php?id=<?php echo $software['id']; ?>">Pogledaj proizvod</a>
<?php }

include_once 'footer.php';
?>