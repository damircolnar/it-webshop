<?php
session_start();
ob_start();
if(!$_SESSION['role'] == 1) {
	header("Location: /wshop/prijava.php");
}

$_pageTitle = 'Početna stranica';
include_once 'header.php';
?>

<h4>Ovo je početna stranica Administracije, ovdje možete raditi u biti sve što se odnosi na stranicu
<span style="color: blue;">"Proizvodi", "Korisnici", "Kategorije", "Izdvojeni Proizvodi".</span></h4>

<?php
include_once 'footer.php';
?>