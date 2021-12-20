<?php
	//ARQUIVO PARA BUSCAR OS BLOCOS DO CALENDARIO
	//E VERIFICAR A SEMANA

	$verificaSemanaBlocoCalendario = $pdo->prepare("SELECT * FROM bloco_calendario WHERE id_calendario = '$idCalendario' $periodoBuscado");
	$verificaSemanaBlocoCalendario->execute();
	$totalSemanaBlocoCalendario = $verificaSemanaBlocoCalendario->fetchAlL(); 
?>