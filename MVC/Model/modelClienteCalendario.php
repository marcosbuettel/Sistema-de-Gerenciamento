<?php
	//ARQUIVO PARA BUSCAR OS CALENDARIOS QUE 
	//PERTENCEM AO CLIENTE SOLICITADO

	$verificaClienteCalendario = $pdo->prepare("SELECT * FROM calendario WHERE id_cliente = '$idCliente'");
	$verificaClienteCalendario->execute();
	$totalClienteCalendario = $verificaClienteCalendario->fetchAlL(); 
?>