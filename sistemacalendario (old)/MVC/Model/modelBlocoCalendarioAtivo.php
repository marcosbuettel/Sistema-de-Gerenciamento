<?php
	$verificaBlocoAtivo = $pdo->prepare("SELECT * FROM bloco_calendario WHERE id_calendario = '$idCalendario'");
	$verificaBlocoAtivo->execute();
	$totalBlocoAtivo = $verificaBlocoAtivo->fetchAlL(); 
?>