<?php 
	$notificacaoPorUsuario = $pdo->prepare("SELECT * FROM notificacao_usuario WHERE id_notificacao = '$idNotificacao' AND id_usuario = '$idUsuarioLogado'");
	$notificacaoPorUsuario->execute();
	$totalVerificarNotificacaoPorUsuario = $notificacaoPorUsuario->fetchAlL(); 
?>