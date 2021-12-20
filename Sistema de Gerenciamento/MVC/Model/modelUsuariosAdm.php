<?php
	//ARQUIVO PARA BUSCAR OS USUARIOS QUE SÃO ADM E MASTER

	$verificaUsuariosAdm = $pdo->prepare("SELECT * FROM usuarios WHERE tipo_usuario = 'adm' OR tipo_usuario = 'master'");
	$verificaUsuariosAdm->execute();
	$totalUsuariosAdm = $verificaUsuariosAdm->fetchAlL(); 
?>