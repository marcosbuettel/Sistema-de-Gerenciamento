<?php 
	$verificaLink = $pdo->prepare("SELECT * FROM bloco_calendario WHERE id_bloco_calendario = '$idBlocoCalendarioLink'");
	$verificaLink->execute();
	$totalLink = $verificaLink->fetchAlL(); 
?>