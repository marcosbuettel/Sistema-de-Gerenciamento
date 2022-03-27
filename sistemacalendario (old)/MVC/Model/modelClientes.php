<?php
	$verificaClientes = $pdo->prepare("SELECT * FROM clientes");
	$verificaClientes->execute();
	$totalClientes = $verificaClientes->fetchAlL(); 
?>