<?php
	//ARQUIVO PARA BUSCAR OS PROJETOS
	//QUER PERTENCEM AO CLIENTE SOLICITADO

	$verificaCalendarioCliente = $pdo->prepare("SELECT * FROM clientes INNER JOIN projeto ON clientes.id_cliente = $idClienteProjeto");
	$verificaCalendarioCliente->execute();
	$totalClientes = $verificaCalendarioCliente->fetchAlL();
?>