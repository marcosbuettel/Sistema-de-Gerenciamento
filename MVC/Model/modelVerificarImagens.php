<?php
	//ARQUIVO PARA BUSCAR AS IMAGENS QUE FORAM CADASTRADAS
	//NOS COMENTARIOS DO BLOCO DO CALENDARIO
	//NÃO ESTÁ MAIS EM USO

	$verificaImagens = $pdo->prepare("SELECT * FROM imagens_comentario WHERE id_comentario_bloco_calendario = '$idComentario'");
	$verificaImagens->execute();
	$totalImagens = $verificaImagens->fetchAlL(); 
?>