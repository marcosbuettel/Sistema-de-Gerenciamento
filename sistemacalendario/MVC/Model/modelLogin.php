<?php
	$verificaUsuario = $pdo->prepare("SELECT * FROM usuarios");
	$verificaUsuario->execute();
	$totalUsuarios = $verificaUsuario->fetchAlL(); 
?>