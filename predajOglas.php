<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: index.php");
}

$_pageTitle = 'Predaj Oglas / Dodaj Proizvod';
$_pageDesicription = 'Predajte Vaš oglas ovdje besplatno!';
include_once 'header.php'; 

if(!empty($_POST)) {
	$query = "INSERT INTO products(name, desicription, productImg, price, quantity, categoryId) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $db->prepare($query);
	if(!$stmt) {
		echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
	} else {
		$imageName = time() . '_' . $_FILES['productImg']['name'];
		$stmt->bind_param('sssiii', $_POST['name'], $_POST['desicription'], $imageName, $_POST['price'], $_POST['quantity'], $_POST['category']);
		$result = $stmt->execute();
		$productId = $stmt->insert_id;
		header("Location: index.php");
		if(!$result) {
			echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
		}
		$stmt->close();
	}
	$fileName = time() . '_' . $_FILES['productImg']['name'];
	$fileType = $_FILES['productImg']['type'];
	$fileSize = $_FILES['productImg']['size'];
	$fileTemp = $_FILES['productImg']['tmp_name'];

	move_uploaded_file($fileTemp, 'images/' . $fileName);
}

?>

<form action="" method="POST" enctype="multipart/form-data">
	<label for="name">Ime proizvoda:</label><br>
	<input type="text" name="name" id="name" autofocus required><br>

	<label for="desicription">Opis proizvoda:</label><br>
	<textarea name="desicription" id="desicription" cols="30" rows="10"></textarea><br>

	<label for="productImg">Slika proizvoda:</label><br>
	<input type="file" name="productImg" id="productImg" required><br>

	<label for="price">Cijena proizvoda:</label><br>
	<input type="number" name="price" id="price" required><br>

	<label for="quantity">Količina:</label><br>
	<input type="number" name="quantity" id="quantity" required><br>

	<label for="category">Kategorija proizvoda:</label><br>
	<select name="category" id="category" required>
		<option value="">// Odaberite kategoriju \\</option>
		<?php
		$query = "SELECT * FROM categories";
		$result = $db->query($query);
		if(!$result) {
			echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
		}

		while($categorie = $result->fetch_assoc()) { ?>
			<option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['id'] . ' | ' . $categorie['name']; ?></option>
		<?php } ?>
	</select><br><br>

	<button type="submit" class="uredi-btn">Predaj oglas</button>
</form>

<?php
include_once 'footer.php';
?>