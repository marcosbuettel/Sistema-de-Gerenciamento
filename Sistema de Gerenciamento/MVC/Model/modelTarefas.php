<?php
	//ARQUIVO PARA VERIFICAR TODAS AS TAREFAS

	$verificaTarefas = $pdo->prepare("SELECT * FROM tarefa ORDER BY prazo_tarefa");
	$verificaTarefas->execute();
	$totalTarefas = $verificaTarefas->fetchAlL(); 
?>