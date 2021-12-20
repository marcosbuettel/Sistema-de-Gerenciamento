<?php
	$verificaCalendarioCliente = $pdo->prepare("SELECT * FROM clientes INNER JOIN projeto ON clientes.id_cliente = $idClienteProjeto");
	$verificaCalendarioCliente->execute();
	$totalClientes = $verificaCalendarioCliente->fetchAlL();
?>