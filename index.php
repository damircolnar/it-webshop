<?php
session_start();
ob_start();

$_pageTitle = 'Početna stranica';
$_pageDesicription = 'Webshop Trgovina Informatičkom opremom';
include_once 'header.php';

echo '<h1>Odaberite kategoriju:</h1><br>';

$query = "SELECT * FROM categories";
$result = $db->query($query);
if(!$result) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->connect_error;
}

$query1 = "SELECT * FROM top_products";
$result1 = $db->query($query1);
if(!$result1) {
	echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
}

$numberOfTopProducts = $result1->num_rows;
?>

<div class="topProducts">
	<h3>BestBuy proizvodi:</h3>
	<?php
	if($numberOfTopProducts > 0) {
		while($topProduct = $result1->fetch_assoc()) { ?>
			<ul>
				<li><strong>Naziv proizvoda: </strong><?php echo $topProduct['name']; ?></li>
				<li><strong>Opis: </strong><?php echo $topProduct['desicription']; ?></li>
				<li><strong>Cijena: </strong><?php echo $topProduct['price'] . ' KN'; ?></li><hr>
			</ul>
		<?php }
	} else {
		echo 'Trenutno nema BestBuy proizvoda.<br>';
	}
	?>
</div><br>

<div class="categories">
	<nav>
		<ul>
	<?php
	while($categorie = $result->fetch_assoc()) { ?>
			<li><a href="<?php echo $categorie['name'] . '.php'; ?>"><?php echo $categorie['name'] . '<br>' . $categorie['desicription']; ?></a></li>
	<?php } ?>
		</ul>
	</nav>
</div>

<?php
include_once 'footer.php';
?>