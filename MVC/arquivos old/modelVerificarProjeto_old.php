<?php
	//ARQUIVO PARA BUSCAR O PROJETO SOLICITADO

	$verificaCalendario = $pdo->prepare("SELECT * FROM projeto WHERE id_projeto = '$idCalendario'");
	$verificaCalendario->execute();
	$totalCalendario = $verificaCalendario->fetchAlL(); 
?>