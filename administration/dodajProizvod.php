<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Dodaj Proizvod';
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
		header("Location: products.php");
		if(!$result) {
			echo 'Došlo je do greške prilikom izvršavanja upita ' . $stmt->connect_error;
		}
		$stmt->close();
	}
	$fileName = time() . '_' . $_FILES['productImg']['name'];
	$fileType = $_FILES['productImg']['type'];
	$fileSize = $_FILES['productImg']['size'];
	$fileTemp = $_FILES['productImg']['tmp_name'];

	move_uploaded_file($fileTemp, '../images/' . $fileName);
}
?>

<form action="" method="POST" class="form-group" enctype="multipart/form-data">
	<label for="name">Ime Proizvoda:</label>
	<input type="text" name="name" id="name" autofocus required class="form-control">

	<label for="desicription">Opis proizvoda:</label>
	<textarea name="desicription" id="desicription" class="form-control"></textarea>

	<label for="productImg">Slika proizvoda:</label>
	<input type="file" name="productImg" id="productImg" class="form-control"><br>

	<label for="price">Cijena:</label>
	<input type="number" name="price" id="price" required class="form-control">

	<label for="quantity">Količina:</label>
	<input type="number" name="quantity" id="quantity" required class="form-control">

	<label for="category">Kategorija:</label>
	<select name="category" id="category" class="form-control">
		<?php
		$categoryQuery = "SELECT * FROM categories";
		$categoryResult = $db->query($categoryQuery);
		while($category = $categoryResult->fetch_assoc()) { ?>
			<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
		<?php } ?>
	</select><br>

	<button type="submit" class="btn btn-primary">Dodaj</button>
</form>

<?php
include_once 'footer.php';
?>