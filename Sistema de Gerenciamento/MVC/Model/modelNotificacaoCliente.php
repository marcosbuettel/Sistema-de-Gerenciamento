<?php
	//ARQUIVO PARA BUSCAR O CLIENTE QUE FEZ A SOLICITAÇÃO

	$verificaClientes = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente = '$idNotificacaoCliente'");
	$verificaClientes->execute();
	$totalClientesNotificacao = $verificaClientes->fetchAlL(); 
?>