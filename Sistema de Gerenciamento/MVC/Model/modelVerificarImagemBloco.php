<?php
	//ARQUIVO PARA BUSCAR IMAGENS CADASTRADAS NO BLOCO DO CALENDARIO
	//NO BLOCO SOLICITADO

	$verificaImagemBloco = $pdo->prepare("SELECT * FROM imagens_bloco WHERE id_bloco_calendario = '$idBlocoCalendario' ORDER BY nome_formatado_imagem_bloco");
	$verificaImagemBloco->execute();
	$totalImagemBloco = $verificaImagemBloco->fetchAlL(); 
?>