<!DOCTYPE html>
<head>
	<title><?php echo $_pageTitle; ?> | Administracija</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
	include_once '../db.php';
	?>
</head>

<body>
<div class="container">
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
	  <a class="navbar-brand" href="index.php">Webshop Administracija</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarText">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="index.php">Početna</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="products.php">Proizvodi</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="users.php">Korisnici</a>
	      </li>
	      <li class="nav-item">
	      	<a class="nav-link" href="categories.php">Kategorije</a>
	      </li>
	      <li class="nav-item">
			<a class="nav-link" href="topProducts.php">Izdvojeni Proizvodi</a>
	      </li>
	      <li class="nav-item">
	      	<a class="nav-link" href="../logout.php">Odjava</a>
	      </li>
	    </ul>
	  </div>
	</nav>
	<br>
	<br>
	<br>

	<h1><?php echo $_pageTitle; ?></h1><br>