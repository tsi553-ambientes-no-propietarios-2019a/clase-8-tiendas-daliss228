<?php 


if($_GET) {
	if(isset($_GET['store'])) {
		$store = $_GET['store'];
	}
}

$id = $_SESSION['user']['id'];
$checkstore = "SELECT * FROM user WHERE store = '$store' AND id = '$id'";

$res = $conn->query($checkstore);

if ($conn->error) {
	redirect('../index.php?error_message=Ocurrió un error: ' . $conn->error);
}

if($res->num_rows > 0) { ?>

<br><a href="new_product.php">Ingresar un nuevo producto</a>

<?php } ?>