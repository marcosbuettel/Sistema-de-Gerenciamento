<?php
	//ARQUIVO PARA VERIFICAR TODOS OS BLOCOS QUE TEM 
	//ALGUMA POSTAGEM DENTRO DELES
	//SE O BLOCO ESTIVER VAZIO, NÃO SERÁ ENCONTRADO NA BUSCA

	$verificaBlocoAtivo = $pdo->prepare("SELECT * FROM bloco_calendario WHERE id_calendario = '$idCalendario' ORDER BY prazo_bloco_calendario");
	$verificaBlocoAtivo->execute();
	$totalBlocoAtivo = $verificaBlocoAtivo->fetchAlL(); 
?>