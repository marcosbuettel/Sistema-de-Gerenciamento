<?php
	$verificaComentarioBlocoCalendario = $pdo->prepare("SELECT * FROM comentario_bloco_calendario WHERE id_bloco_calendario = '$idBlocoCalendario'");
	$verificaComentarioBlocoCalendario->execute();
	$totalComentarioBlocoCalendario = $verificaComentarioBlocoCalendario->fetchAlL(); 
?>