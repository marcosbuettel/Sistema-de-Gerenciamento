<?php
	$verificaCalendario = $pdo->prepare("SELECT * FROM calendario WHERE id_calendario = '$idCalendario'");
	$verificaCalendario->execute();
	$totalCalendario = $verificaCalendario->fetchAlL(); 
?>