<?php 
	$verificaSemanaTarefa = $pdo->prepare("SELECT * FROM semana_quadro_tarefa");
	$verificaSemanaTarefa->execute();
	$totalSemanaTarefa = $verificaSemanaTarefa->fetchAlL(); 
?>