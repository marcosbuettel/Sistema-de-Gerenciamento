<?php
	$verificaClientes = $pdo->prepare("SELECT * FROM clientes WHERE nome_cliente = '$clienteCalendario'");
	$verificaClientes->execute();
	$totalClientes = $verificaClientes->fetchAlL(); 
?>