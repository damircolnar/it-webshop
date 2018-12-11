<?php
include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $_pageTitle; ?> | Webshop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">

	<?php
	if(isset($_SESSION['memberUsername'])) {
		$cartItems = 'SELECT * FROM cart_items WHERE userId = ' . $_SESSION['uid'];
		$resultItems = $db->query($cartItems);

		$ItemsInCart = $resultItems->num_rows;

		$invoicesQuery = 'SELECT * FROM invoices WHERE userId = ' . $_SESSION['uid'];
		$invoicesResult = $db->query($invoicesQuery);

		$invoicesNumber = $invoicesResult->num_rows;
	}
	?>

	<nav>
		<ul>
			<li><a href="index.php">Početna</a></li>
			<li><a href="administration/">Administracija</a></li>
			<?php
			if(isset($_SESSION['memberUsername'])) { ?>
			<li><a href="profil.php?id=<?php echo $_SESSION['uid']; ?>">Moj Profil</a></li>
			<li><a href="predajOglas.php">Dodaj Oglas / Predaj</a></li>
			<li><a href="kosarica.php" style="color: blue; font-weight: bold;">Košarica (<?php echo $ItemsInCart; ?>)</a></li>
			<li><a href="racuni.php" style="color: blue; font-weight: bold;">Računi (<?php echo $invoicesNumber; ?>)</a></li>
			<li><a href="logout.php">Odjava</a></li>
			<?php } else { ?>
			<li><a href="prijava.php">Prijava</a></li>
			<li><a href="registracija.php">Registracija</a></li>
			<?php } ?>
		</ul>
	</nav>

	<header>
		<h1><?php echo $_pageTitle; ?> | Webshop</h1>
		<p><?php echo $_pageDesicription; ?></p>
		<?php
		if(isset($_SESSION['memberUsername'])) {
			$query = 'SELECT * FROM users WHERE id = ' . $_SESSION['uid'];
			$result = $db->query($query);
			if(!$result) {
				echo 'Došlo je do greške prilikom izvršavanja upita ' . $db->error;
			}

			while($user = $result->fetch_assoc()) {
				if($user['activated'] == 0) { ?>
					<strong>Molimo Vas aktivirajte Vaš korisnički račun <a href="activateProfile.php">Aktivacija Profila</a></strong>
				<?php }
			}
		}
		?>
		<form action="search.php" method="GET">
			<input type="text" name="search" placeholder="Pretraži proizvode...">
			<button type="submit" class="search-btn">Traži</button>
		</form>
	</header>

	<div class="content">

