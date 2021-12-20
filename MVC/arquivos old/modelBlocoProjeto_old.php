<?php
	//ARQUIVO PARA VERIFICAR OS BLOCOS DO PROJETO QUE FAZEM 
	//PARTE DAQUELE CALENDARIO
	//NÃO ESTÁ SENDO USADO AINDA, POSSIVELMENTE USAREMOS AS SOLICITAÇÕES
	//NO LUGAR DESSE ARQUIVO

	$verificaBlocosProjeto = $pdo->prepare("SELECT * FROM bloco_projeto WHERE id_projeto = '$idCalendario'");	

	$verificaBlocosProjeto->execute();
	$totalBlocosProjeto = $verificaBlocosProjeto->fetchAlL(); 	
?>