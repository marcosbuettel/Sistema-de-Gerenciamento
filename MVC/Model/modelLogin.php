<?php
	//ARQUIVO PARA BUSCAR OS USUÁRIOS PARA PODER CONFERIR
	//OS DADOS NA HORA DO LOGIN

	$verificaUsuario = $pdo->prepare("SELECT * FROM usuarios");
	$verificaUsuario->execute();
	$totalUsuarios = $verificaUsuario->fetchAlL(); 
?>