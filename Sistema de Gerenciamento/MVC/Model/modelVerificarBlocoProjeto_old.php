<?php
	//ARQUIVO PARA BUSCAR O BLOCO DO PROJETO 
	//NA POSIÇÃO SOLICITADA

	$verificaBlocoProjeto = $pdo->prepare("SELECT * FROM bloco_projeto WHERE posicao_bloco_projeto = '$i' AND id_projeto = '$idCalendario'");
	$verificaBlocoProjeto->execute();
	$totalBlocoProjeto = $verificaBlocoProjeto->fetchAlL(); 
?>