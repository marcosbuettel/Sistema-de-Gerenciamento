<?php 
	$verificaClientes = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente = '$idCliente'");
	$verificaClientes->execute();
	$totalClientes = $verificaClientes->fetchAlL(); 
?>