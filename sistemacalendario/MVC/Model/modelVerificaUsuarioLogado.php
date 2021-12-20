<?php
	$verificaUsuarioLogado = $pdo->prepare("SELECT * FROM usuarios WHERE nome_usuario = '$usuarioLogado'");
	$verificaUsuarioLogado->execute();
	$totalUsuarioLogado = $verificaUsuarioLogado->fetchAlL(); 
?>