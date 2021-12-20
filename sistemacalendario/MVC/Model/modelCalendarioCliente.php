<?php
	$verificaCalendarioCliente = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente = '$idCliente'");
	$verificaCalendarioCliente->execute();
	$totalCalendarioCliente = $verificaCalendarioCliente->fetchAlL(); 
?>