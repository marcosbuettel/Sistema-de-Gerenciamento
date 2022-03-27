<?php
	//ARQUIVO PARA VERIFICAR A TAREFA SELECIONADA

	$verificaTarefas = $pdo->prepare("SELECT * FROM tarefa WHERE id_tarefa = '$idTarefa'");
	$verificaTarefas->execute();
	$totalTarefas = $verificaTarefas->fetchAlL(); 
?>