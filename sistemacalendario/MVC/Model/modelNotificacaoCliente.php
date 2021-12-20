<?php
	$verificaClientes = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente = '$idNotificacaoCliente'");
	$verificaClientes->execute();
	$totalClientesNotificacao = $verificaClientes->fetchAlL(); 
?>