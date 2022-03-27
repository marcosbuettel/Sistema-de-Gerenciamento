<?php
	//ARQUIVO PARA BUSCAR AS TAREFAS REFERENTES A CADA PROJETO
	
	$verificaTarefasProjeto = $pdo->prepare("SELECT * FROM tarefa_projeto WHERE id_projeto = '$idProjeto' ORDER BY prazo_tarefa_projeto");		
	$verificaTarefasProjeto->execute();
	$totalTarefasProjeto = $verificaTarefasProjeto->fetchAlL(); 
?>