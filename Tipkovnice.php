<?php
session_start();
ob_start();

$_pageTitle = 'Tipkovnice';
$_pageDesicription = 'Profesionalne tipkovnice za računala';
include_once 'header.php';

echo '<h1>' . $_pageTitle . '</h1>';
echo $_pageDesicription . '<br><br>';

$query = "SELECT products.id, products.name, products.desicription, products.productImg, products.price, products.quantity, products.categoryId FROM products LEFT JOIN categories ON products.categoryId = categories.id WHERE categories.id = 1";
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->connect_error;
}

while($tipkovnica = $result->fetch_assoc()) {
	echo '<br><br><h3 style="color: red;">' . $tipkovnica['name'] . '</h3>';
	echo '<strong>' . $tipkovnica['desicription'] . '</strong><br>';
	echo 'Cijena: ' . $tipkovnica['price'] . ' kn<br>'; ?>
	<img src="images/<?php echo $tipkovnica['productImg']; ?>" alt="productImg" width="100" height="100"><br>
	<?php
	if($tipkovnica['quantity'] == 0) {
		echo '<strong style="color: red;">Uskoro dolazi!</strong><br>';
	} else {
		echo 'Stanje na skladištu : ' . $tipkovnica['quantity'] . ' KOM<br><br>';
		if(isset($_SESSION['memberUsername'])) { ?>
			<a href="addtocart.php?id=<?php echo $tipkovnica['id']; ?>">Dodaj u Košaricu</a>
		<?php } ?>
	<?php } ?>
		<a href="product.php?id=<?php echo $tipkovnica['id']; ?>">Pogledaj Proizvod</a>
<?php }

include_once 'footer.php';
?>