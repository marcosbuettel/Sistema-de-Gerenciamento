<?php
	//ARQUIVO PARA BUSCAR O COMENTARIO QUE FOI FEITO NO BLOCO
	//DO CALENDARIO NO BLOCO SOLICITADO

	$verificaComentarioBlocoCalendario = $pdo->prepare("SELECT * FROM comentario_bloco_calendario WHERE id_bloco_calendario = '$idBlocoCalendario'");
	$verificaComentarioBlocoCalendario->execute();
	$totalComentarioBlocoCalendario = $verificaComentarioBlocoCalendario->fetchAlL(); 
?>