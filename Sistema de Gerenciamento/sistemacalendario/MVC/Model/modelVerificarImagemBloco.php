<?php
	$verificaImagemBloco = $pdo->prepare("SELECT * FROM imagens_bloco WHERE id_bloco_calendario = '$idBlocoCalendario' ORDER BY nome_imagem_bloco");
	$verificaImagemBloco->execute();
	$totalImagemBloco = $verificaImagemBloco->fetchAlL(); 
?>