<?php
	$verificaProjetos = $pdo->prepare("SELECT * FROM projeto ORDER BY id_projeto DESC");
	$verificaProjetos->execute();
	$totalCalendarios = $verificaProjetos->fetchAlL(); 
?>