<?php
	$verificaUsuarios = $pdo->prepare("SELECT * FROM usuarios");
	$verificaUsuarios->execute();
	$totalUsuarios = $verificaUsuarios->fetchAlL(); 
?>