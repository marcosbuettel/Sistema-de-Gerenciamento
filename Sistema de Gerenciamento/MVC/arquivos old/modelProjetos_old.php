<?php
	//ARQUIVO PARA BUSCAR TODOS OS PROJETOS

	$verificaProjetos = $pdo->prepare("SELECT * FROM projeto ORDER BY id_projeto DESC");
	$verificaProjetos->execute();
	$totalCalendarios = $verificaProjetos->fetchAlL(); 
?>