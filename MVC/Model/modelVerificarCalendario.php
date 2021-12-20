<?php
	//ARQUIVO PARA BUSCAR O CALENDARIO SOLICITADO

	$verificaCalendario = $pdo->prepare("SELECT * FROM calendario WHERE id_calendario = '$idCalendario'");
	$verificaCalendario->execute();
	$totalCalendario = $verificaCalendario->fetchAlL(); 
?>