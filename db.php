<?php
$db = @new mysqli("localhost", "root", "", "wshop");

if($db->connect_error) {
	echo 'Došlo je do greške prilikom spajanja na bazu ' . $db->error;
	die();
}

if(!$db->set_charset('utf8mb4')) {
	echo 'Došlo je do greške prilikom postavljanja charset-a ' . $db->connect_error;
}
?>