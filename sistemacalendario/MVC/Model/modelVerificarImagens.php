<?php
	$verificaImagens = $pdo->prepare("SELECT * FROM imagens_comentario WHERE id_comentario_bloco_calendario = '$idComentario'");
	$verificaImagens->execute();
	$totalImagens = $verificaImagens->fetchAlL(); 
?>