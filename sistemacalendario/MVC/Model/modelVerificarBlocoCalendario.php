<?php
	$verificaBlocoCalendario = $pdo->prepare("SELECT * FROM bloco_calendario WHERE id_bloco_calendario = '$idBlocoCalendario'");
	$verificaBlocoCalendario->execute();
	$totalBlocoCalendario = $verificaBlocoCalendario->fetchAlL(); 
?>