<?php
	//ARQUIVO PARA VERIFICAR TODOS OS BLOCOS QUE TEM 
	//O ID DA TAREFA CLICADA

	$verificaBlocoPorTarefa = $pdo->prepare("SELECT * FROM bloco_calendario WHERE id_tarefa = '$idTarefa' ORDER BY prazo_bloco_calendario");
	$verificaBlocoPorTarefa->execute();
	$totalBlocoPorTarefa = $verificaBlocoPorTarefa->fetchAlL(); 
?>