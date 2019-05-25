<?php 
session_start();


$conn = new mysqli('localhost', 'root', '', 'tiendas');

if($conn->connect_error) {
	echo 'Existió un error en la conexión ' . $conn->connect_error;
	exit;
}

function redirect($url) {
	header('Location: ' . $url);
	exit;
}

function getProducts($conn) {
	$user_id = $_SESSION['user']['id'];
	$sql = "SELECT *
		FROM product
		WHERE user='$user_id'";

		$res = $conn->query($sql);

		if ($conn->error) {
			redirect('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$products = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$products[] = $row;
			}
		}

		return $products;
}


function getStores($conn) {
	$user_id = $_SESSION['user']['id'];
	$sql = "SELECT store
		FROM user
		WHERE id !='$user_id'";

		$res = $conn->query($sql);

		if ($conn->error) {
			redirect('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$tiendas = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$tiendas[] = $row;
			}
		}

		return $tiendas;
}

function getOtherProducts($conn, $tienda) {

	$sql = "SELECT p.code, p.name, p.type, p.stock, p.price FROM product p JOIN user u ON p.user = u.id WHERE u.store = '$tienda'";

		$res = $conn->query($sql);

		if ($conn->error) {
			redirect('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$otherProducts = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$otherProducts[] = $row;
			}
		}

		if (!empty($otherProducts)) {
			return $otherProducts;
		}else{
			return 0;
		}
		//return $otherProducts;

}		

$public_pages = [
	'/tiendas/index.php', 
	'/tiendas/php/process_login.php',
	'/tiendas/registration.php',
	'/tiendas/php/process_registration.php'
];
/*
if ( !isset($_SESSION['user']) && !in_array( $_SERVER['SCRIPT_NAME'], $public_pages)) {
	redirect($_SERVER["HTTP_HOST"] . '/tiendas/index.php');
} elseif( 
	isset($_SESSION['user']) && (
	$_SERVER['SCRIPT_NAME'] == '/tiendas/index.php' || 
	$_SERVER['SCRIPT_NAME'] == '/tiendas/registration.php')) {
	redirect($_SERVER["HTTP_HOST"] . '/tiendas/home.php');
}*/

