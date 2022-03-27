<?php
	//ARQUIVO PARA BUSCAR TODOS OS PROJETOS
	

	if(isset($_POST['pesquisar-tarefas'])){
		$verificaProjetos = $pdo->prepare("SELECT * FROM projetos INNER JOIN tarefa_projeto ON projetos.id_projeto = tarefa_projeto.id_projeto WHERE nome_tarefa_projeto LIKE '%$tarefaBuscada%' OR nome_projeto LIKE '%$tarefaBuscada%' OR responsavel_tarefa_projeto LIKE '%$tarefaBuscada%' GROUP BY projetos.id_projeto");
	}else{
		$verificaProjetos = $pdo->prepare("SELECT * FROM projetos ORDER BY nome_projeto");	
	}
	
	$verificaProjetos->execute();
	$totalProjetos = $verificaProjetos->fetchAlL(); 
?>