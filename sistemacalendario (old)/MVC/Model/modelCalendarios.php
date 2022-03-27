<?php
	$verificaCalendarios = $pdo->prepare("SELECT * FROM calendario ORDER BY id_calendario DESC");
	$verificaCalendarios->execute();
	$totalCalendarios = $verificaCalendarios->fetchAlL(); 
?>