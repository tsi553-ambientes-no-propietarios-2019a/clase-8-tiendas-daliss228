<?php 

include('common/utils.php');

if($_GET) {
	if(isset($_GET['store'])) {
		$store = $_GET['store'];
	}
}

$otherproducts = getOtherProducts($conn, $store);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
echo 'Tienda: '.$store;
include('php/process_store.php'); 
if ($otherproducts!=0) {?>

<table border="1">
	<thead>
		<tr>
			<th>Código</th>
			<th>Nombre</th>
			<th>Tipo</th>
			<th>Stock</th>
			<th>Precio</th>
		</tr>
	</thead>

	<tbody>
	<?php foreach ($otherproducts as $op) { ?>
		<tr>
			<td><?php echo $op['code'] ?></td>
			<td><?php echo $op['name'] ?></td>
			<td><?php echo $op['type'] ?></td>
			<td><?php echo $op['stock'] ?></td>
			<td><?php echo $op['price'] ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
	
<?php 
}else{
	echo "<br>".'No hay productos en la tienda';
} 
?>

</body>
</html>
