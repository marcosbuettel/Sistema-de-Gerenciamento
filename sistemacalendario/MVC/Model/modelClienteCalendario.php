<?php
	$verificaClienteCalendario = $pdo->prepare("SELECT * FROM calendario WHERE id_cliente = '$idCliente'");
	$verificaClienteCalendario->execute();
	$totalClienteCalendario = $verificaClienteCalendario->fetchAlL(); 
?>