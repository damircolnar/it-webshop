<?php
session_start();
ob_start();

$_pageTitle = 'Search';
$_pageDesicription = '';
if(isset($_GET['search'])) {
$searchQuery = $_GET['search'];
}
include_once 'header.php';

$minLength = 3;

if(isset($searchQuery)) {
	if(strlen($searchQuery) >= $minLength) {
		$query = "SELECT id, name FROM products WHERE name LIKE '%" . $searchQuery . "%'";
		$result = $db->query($query);
		if($result->num_rows > 0) {
			echo '<h1>Pronađeni proizvodi:</h1>';
			while($results = $result->fetch_assoc()) { ?>
				<a href="product.php?id=<?php echo $results['id']; ?>" class="search-result"><?php echo $results['name'] . '<br>'; ?></a>
			<?php }
		} else {
			echo 'Nema nađenih proizvoda';
		}
	} else {
		echo 'Morate unjeti najmanje 3 znaka za pretraživanje.';
	}
}

include_once 'footer.php';
?>