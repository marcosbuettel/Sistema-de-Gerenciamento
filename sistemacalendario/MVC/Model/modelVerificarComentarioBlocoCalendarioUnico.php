<?php
	$verificaComentarioBlocoCalendarioUnico = $pdo->prepare("SELECT * FROM comentario_bloco_calendario WHERE id_comentario_bloco_calendario = '$idComentarioAtual'");
	$verificaComentarioBlocoCalendarioUnico->execute();
	$totalComentarioBlocoCalendarioUnico = $verificaComentarioBlocoCalendarioUnico->fetchAlL(); 
?>