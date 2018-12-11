<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Uređivanje proizvoda';
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
?>

<a href="products.php" class="btn btn-primary">Natrag na proizvode</a><br><br>

<?php
if(!empty($_POST)) {
	$query = "UPDATE products SET name = ?, desicription = ?, productImg = ?, price = ?, quantity = ?, categoryId = ? WHERE id = ?";
	$stmt = $db->prepare($query);
	if(!$stmt) {
		echo 'Došlo je do greške prilikom pripremanja upita ' . $db->error;
	} else {
		$imageName = time() . '_' . $_FILES['productImg']['name'];
		$stmt->bind_param('sssiiii', $_POST['name'], $_POST['desicription'], $imageName, $_POST['price'], $_POST['quantity'], $_POST['category'], $productId);
		$result = $stmt->execute();
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
	<label for="name">Ime proizvoda:</label>
	<input type="text" name="name" id="name" value="<?php echo $name; ?>" autofocus required class="form-control">

	<label for="desicription">Opis proizvoda:</label>
	<textarea name="desicription" id="desicription" class="form-control"><?php echo $desicription; ?></textarea>

	<label for="productImg">Slika proizvoda:</label>
	<input type="file" name="productImg" id="productImg" class="form-control" required><br>

	<label for="price">Cijena:</label>
	<input type="number" name="price" id="price" value="<?php echo $price; ?>" required class="form-control">

	<label for="quantity">Količina:</label>
	<input type="number" name="quantity" id="quantity" value="<?php echo $quantity; ?>" required class="form-control">

	<label for="catrgory">Kategorija:</label>
	<select name="category" id="category" class="form-control">
		<option value="<?php echo $categoryId; ?>" style="background-color: blue; color: white;">
			<?php
			if($categoryId == 1) { ?>
				Odaberite kategoriju ukoliko želite promjeniti.. Trenutna kategorija: Tipkovnice
			<?php } else if($categoryId == 2) { ?>
				Odaberite kategoriju ukoliko želite promjeniti.. Trenutna kategorija: Software
			<?php } ?>
		</option>
		<?php
		$categoryQuery = "SELECT * FROM categories";
		$categoryResult = $db->query($categoryQuery);
		while($category = $categoryResult->fetch_assoc()) { ?>
			<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
		<?php } ?>
	</select><br>

	<button type="submit" class="btn btn-primary">Promjeni</button>
</form>

<?php
include_once 'footer.php';
?>